<?php

namespace GitScrum\Http\Controllers\Web;

use GitScrum\Models\ProductBacklog;
use Illuminate\Http\Request;
use Session;
use Auth;

class WizardController extends Controller
{
 

    public function step1($provider)
    {
        switch ($provider) {
            case 'github':
                /**  start gihub provider **/
                $repositories = (object) app(Auth::user()->githubUser()->provider)
                ->readRepositories();
                $currentRepositories = ProductBacklog::all();

                Session::put('Repositories', $repositories);

                return view('wizard.step1')
                    ->with('repositories', $repositories)
                    ->with('currentRepositories', $currentRepositories)
                    ->with('columns', ['checkbox', 'repository', 'organization'])
                    ->with('provider',$provider);

                /** end github provider */
                break;
            
            case 'trello':
                /**   start trello provider ***/
                $boards = (object) app(Auth::user()->trelloUser()->provider)
                ->readBoards();

                 return view('wizard.step1')
                    ->with('provider',$provider);
                //dd($boards);
                /**  end trello provider **/
                break;
                
                
        }
        
    }





    public function step2(Request $request)
    {
        $repositories = Session::get('Repositories')->whereIn('provider_id', $request->repos);
        foreach ($repositories as $repository) {
            app(Auth::user()->githubUser()->provider)->readCollaborators($repository->organization_title, $repository->title, $repository->provider_id);
            $product_backlog = ProductBacklog::where('provider_id', $repository->provider_id)->first();
            if (!isset($product_backlog)) {
                $product_backlog = ProductBacklog::create(get_object_vars($repository));
            }
            app(Auth::user()->githubUser()->provider)->createBranches($repository->organization_title, $product_backlog->id, $repository->title, $repository->provider_id);
        }

        return view('wizard.step2')
            ->with('repositories', $repositories)
            ->with('columns', ['repository', 'organization']);
    }

    public function step3()
    {
        $result = app(Auth::user()->githubUser()->provider)->readIssues();

        return redirect()->route('issues.index', ['slug' => 0]);
    }

    public function application(){
        return view('wizard.application');
    }

}
