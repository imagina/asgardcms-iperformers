<?php

namespace Modules\Iperformers\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIperformersSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('iperformers::common.iperformers'), function (Item $item) {
                $item->icon('fa fa-grav');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('iperformers::performers.title.performers'), function (Item $item) {
                    $item->icon('fa fa-grav');
                    $item->weight(0);
                    $item->append('admin.iperformers.performer.create');
                    $item->route('admin.iperformers.performer.index');
                    $item->authorize(
                        $this->auth->hasAccess('iperformers.performers.index')
                    );
                });
                $item->item(trans('iperformers::types.title.types'), function (Item $item) {
                    $item->icon('fa fa-puzzle-piece');
                    $item->weight(0);
                    $item->append('admin.iperformers.type.create');
                    $item->route('admin.iperformers.type.index');
                    $item->authorize(
                        $this->auth->hasAccess('iperformers.types.index')
                    );
                });
                $item->item(trans('iperformers::services.title.services'), function (Item $item) {
                    $item->icon('fa fa-users');
                    $item->weight(0);
                    $item->append('admin.iperformers.service.create');
                    $item->route('admin.iperformers.service.index');
                    $item->authorize(
                        $this->auth->hasAccess('iperformers.services.index')
                    );
                });
                $item->item(trans('iperformers::genres.title.genres'), function (Item $item) {
                    $item->icon('fa fa-globe');
                    $item->weight(0);
                    $item->append('admin.iperformers.genre.create');
                    $item->route('admin.iperformers.genre.index');
                    $item->authorize(
                        $this->auth->hasAccess('iperformers.genres.index')
                    );
                });
// append




            });
        });

        return $menu;
    }
}
