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
        'panel.users.create.admin'                          => [ 1 ],
        'panel.users.create.manager'                        => [ 1 ],
        'panel.users.create.doctor'                         => [ 1 ],
        'panel.users.create.nurse'                          => [ 1 ],
        'panel.users.create.patient'                        => [ 1 ],

        'panel.users.store.admin'                           => [ 1 ],
        'panel.users.store.manager'                         => [ 1 ],
        'panel.users.store.doctor'                          => [ 1 ],
        'panel.users.store.nurse'                           => [ 1 ],
        'panel.users.store.patient'                         => [ 1 ],

        'panel.users.update.admin'                          => [ 1 ],
        'panel.users.update.manager'                        => [ 1, 2 ],
        'panel.users.update.doctor'                         => [ 1, 3 ],
        'panel.users.update.nurse'                          => [ 1, 4 ],
        'panel.users.update.patient'                        => [ 1, 5 ],

        'panel.users.edit'                                  => [ 1, 2, 3, 4, 5 ],
        'panel.users.show'                                  => [ 1, 2, 3, 4, 5 ],
        'panel.users.destroy'                               => [ 1 ],
        'panel.users.index'                                 => [ 1, 2, 3, 4, 5 ],



        'panel.units.index'                                 => [ 1, 2, 3, 4, 5 ],
        'panel.units.create'                                => [ 1, 2 ],
        'panel.units.store'                                 => [ 1, 2 ],
        'panel.units.edit'                                  => [ 1, 2 ],
        'panel.units.update'                                => [ 1, 2 ],
        'panel.units.show'                                  => [ 1, 2, 3, 4, 5 ],
        'panel.units.destroy'                               => [ 1, 2 ],


        'panel.report_templates.index'                      => [ 1, 2, 3, 4 ],
        'panel.report_templates.create'                     => [ 1 ],
        'panel.report_templates.store'                      => [ 1 ],
        'panel.report_templates.edit'                       => [ 1 ],
        'panel.report_templates.update'                     => [ 1 ],
        'panel.report_templates.show'                       => [ 1, 2, 3, 4 ],
        'panel.report_templates.destroy'                    => [ 1 ],


        'panel.experiments.index'                           => [ 1, 2, 3, 4, 5 ],
        'panel.experiments.create'                          => [ 1, 2, 3, 4, 5 ],
        'panel.experiments.store'                           => [ 1, 2, 3, 4, 5 ],
        'panel.experiments.edit'                            => [ 1, 2, 3, 4, 5 ],
        'panel.experiments.update'                          => [ 1, 2, 3, 4, 5 ],
        'panel.experiments.show'                            => [ 1, 2, 3, 4, 5 ],
        'panel.experiments.destroy'                         => [ 1, 2, 3, 4 ],

        'panel.addresses.index'                             => [ 1, 5 ],
        'panel.addresses.create'                            => [ 1, 5 ],
        'panel.addresses.store'                             => [ 1, 5 ],
        'panel.addresses.edit'                              => [ 1, 5 ],
        'panel.addresses.update'                            => [ 1, 5 ],
        'panel.addresses.show'                              => [ 1, 5 ],
        'panel.addresses.destroy'                           => [ 1, 5 ],

        'panel.search.patients'                             => [ 1, 2, 3, 4 ],
        'panel.search.units'                                => [ 1, 2, 3, 4 ],
        'panel.search.doctors'                              => [ 1, 2, 3, 4 ],
        'panel.search.managers'                             => [ 1, 2, 3, 4 ],
        'panel.search.members'                              => [ 1, 2, 3, 4 ],
        'panel.search.joiners'                              => [ 1, 2, 3, 4 ],

        'panel.permissions.create'                          => [ 2, 3, 4 ],
        'panel.permissions.check'                           => [ 2, 3, 4 ],
        'panel.permissions.send'                            => [ 2, 3, 4 ],

        'panel.permissions.show'                            => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.inline_update'                   => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.edit'                            => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.update'                          => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.index'                           => [ 1, 2, 3, 4, 5 ],
        'panel.permissions.destroy'                         => [ 1, 2, 3, 4, 5 ],

        'panel.unit_users.send'                             => [ 2, 3, 4 ],
        'panel.unit_users.index'                            => [ 1, 2 ],
        'panel.unit_users.create.member'                    => [ 1, 2 ],
        'panel.unit_users.create.manager'                   => [ 1, 2 ],
        'panel.unit_users.store'                            => [ 1, 2 ],
        'panel.unit_users.inline_update'                    => [ 1, 2 ],

        'panel.prints.units.index'                          => [ 1, 2, 3, 4, 5 ],
        'panel.prints.units.members'                        => [ 1, 2, 3, 4, 5 ],
        'panel.prints.units.sub_units'                      => [ 1, 2, 3, 4, 5 ],
        'panel.prints.units.info'                           => [ 1, 2, 3, 4, 5 ],
        
        'panel.prints.users.index'                          => [ 1, 2, 3, 4, 5 ],
        'panel.prints.users.info'                           => [ 1, 2, 3, 4, 5 ],
        'panel.prints.users.units'                          => [ 1, 2, 3, 4, 5 ],
        'panel.prints.users.experiments'                    => [ 1, 2, 3, 4, 5 ],
        'panel.prints.users.patients'                       => [ 1, 2, 3, 4, 5 ],
        'panel.prints.users.visitors'                       => [ 1, 2, 3, 4, 5 ],

        'panel.prints.experiments.show'                     => [ 1, 2, 3, 4, 5 ],
        'panel.prints.experiments.index'                    => [ 1, 2, 3, 4, 5 ],

        'panel.prints.unit_users.index'                     => [ 1, 2, 3, 4, 5 ],
        'panel.prints.permissions.index'                    => [ 1, 2, 3, 4, 5 ],
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
