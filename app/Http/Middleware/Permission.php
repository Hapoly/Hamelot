<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    private $roles = [
        'panel.users.create.admin'                      => [ 1 ],
        'panel.users.create.manager'                    => [ 1 ],
        'panel.users.create.doctor'                     => [ 1 ],
        'panel.users.create.nurse'                      => [ 1 ],
        'panel.users.create.patient'                    => [ 1 ],

        'panel.users.store.admin'                       => [ 1 ],
        'panel.users.store.manager'                     => [ 1 ],
        'panel.users.store.doctor'                      => [ 1 ],
        'panel.users.store.nurse'                       => [ 1 ],
        'panel.users.store.patient'                     => [ 1 ],

        'panel.users.update.admin'                      => [ 1 ],
        'panel.users.update.manager'                    => [ 2 ],
        'panel.users.update.doctor'                     => [ 3 ],
        'panel.users.update.nurse'                      => [ 4 ],
        'panel.users.update.patient'                    => [ 5 ],

        'panel.users.edit'                              => [ 1, 2, 3, 4, 5 ],
        'panel.users.show'                              => [ 1, 2, 3, 4, 5 ],
        'panel.users.destroy'                           => [ 1 ],
        'panel.users.index'                             => [ 1, 2, 3, 4, 5 ],

        'panel.hospitals.index'                         => [ 1, 2, 3, 4, 5 ],
        'panel.hospitals.create'                        => [ 1, 2 ],
        'panel.hospitals.store'                         => [ 1, 2 ],
        'panel.hospitals.edit'                          => [ 1, 2 ],
        'panel.hospitals.update'                        => [ 1, 2 ],
        'panel.hospitals.show'                          => [ 1, 2, 3, 4, 5 ],
        'panel.hospitals.destroy'                       => [ 1, 2 ],

        'panel.departments.index'                       => [ 1, 2, 3, 4 ],
        'panel.departments.create'                      => [ 1, 2 ],
        'panel.departments.store'                       => [ 1, 2 ],
        'panel.departments.edit'                        => [ 1, 2 ],
        'panel.departments.update'                      => [ 1, 2 ],
        'panel.departments.show'                        => [ 1, 2, 3, 4, 5 ],
        'panel.departments.destroy'                     => [ 1, 2 ],

        'panel.report_templates.index'                  => [ 1, 2, 3, 4 ],
        'panel.report_templates.create'                 => [ 1 ],
        'panel.report_templates.store'                  => [ 1 ],
        'panel.report_templates.edit'                   => [ 1 ],
        'panel.report_templates.update'                 => [ 1 ],
        'panel.report_templates.show'                   => [ 1, 2, 3, 4 ],
        'panel.report_templates.destroy'                => [ 1 ],


        'panel.experiments.index'                       => [ 1, 2, 3, 4 ],
        'panel.experiments.create'                      => [ 1, 2, 3, 4 ],
        'panel.experiments.store'                       => [ 1, 2, 3, 4 ],
        'panel.experiments.edit'                        => [ 1, 2, 3, 4 ],
        'panel.experiments.update'                      => [ 1, 2, 3, 4 ],
        'panel.experiments.show'                        => [ 1, 2, 3, 4 ],
        'panel.experiments.destroy'                     => [ 1, 2, 3, 4 ],

        'panel.search.patients'                         => [ 1, 2, 3, 4 ],
        'panel.search.patient-departments'              => [ 1, 2, 3, 4 ],

        'panel.permissions.create'                      => [ 2, 3, 4 ],
        'panel.permissions.check'                       => [ 2, 3, 4 ],
        'panel.permissions.send'                        => [ 2, 3, 4 ],

        'panel.permissions.show'                        => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.inline_update'               => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.edit'                        => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.update'                      => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.index'                       => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.destroy'                     => [ 1, 2, 3, 4, 5 ],

        'panel.department_users.send'                   => [ 3, 4 ],
        'panel.department_users.index'                  => [ 1, 2 ],

    ];
    public function handle(Request $request, Closure $next){
        $route = $request->route()->getName();
        if(!array_key_exists($route, $this->roles))
            // abort(404);
            die(json_encode($route));

        $permissions = $this->roles[$route];
        if(in_array(Auth::user()->group_code, $permissions)){
            return $next($request);
        }else
            // die($permissions);
            abort(404);
    }
}
