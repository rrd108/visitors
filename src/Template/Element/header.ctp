<nav>
    <div class="title-bar" data-responsive-toggle="navbar" data-hide-for="medium">
        <button class="menu-icon" type="button" data-toggle="navbar"></button>
        <div class="title-bar-title"><?= __('Menu') ?></div>
    </div>

    <div data-sticky-container>
        <div class="top-bar" id="navbar" data-sticky data-options="marginTop:0;" style="width:100%">
            <div class="top-bar-left">
                <?php if ($this->request->getSession()->read('Auth.User')) : ?>
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li>
                            <?= $this->Html->image('logo.png') ?>
                        </li>
                        <li>
                            <?= $this->MenuLink->menuLink(
                                '<i class="fi-home"> ' . __('Home') . '</i>',
                                [
                                    'plugin' => false,
                                    'controller' => 'CompaniesGrants',
                                    'action' => 'index'
                                ],
                                [
                                    'escape' => false
                                ]
                            ) ?>
                        </li>

                        <?php if ($this->request->getSession()->read('Auth.User.is_superuser')
                            && $this->request->getSession()->read('Auth.User.role') == 'superuser') : ?>
                            <li>
                                <?= $this->MenuLink->menuLink(
                                    '<i class="fi-widget"> ' . __('Main data') . '</i>',
                                    ['plugin' => false],
                                    ['escape' => false]
                                ) ?>
                                <ul class="nested vertical menu">
                                    <li><?= $this->MenuLink->menuLink(
                                            '<i class="fi-torso-business"> ' . __('Companies') . '</i>',
                                            ['plugin' => false, 'controller' => 'companies', 'action' => 'index'],
                                            ['escape' => false]
                                        ) ?></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="top-bar-right">
                <ul class="menu">
                    <li>
                        <?= $this->User->logout(
                            '<span id="username">'
                            . $this->request->session()->read('Auth.User.username') .
                            '</span>'
                            . ' ' . __('Logout'),
                            ['escape' => false]) ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
