<div class="navBarWrapper">
    <div class="scrollbar">
        <div class="largeContainer">
            <div id="navbar-inner" class="flex justify-between py-2">
                <div id="logo-container">
                    <a href="/" class="block">
                        <?php
                        get_template_part( "templates/partials/logo" );
                        ?>
                    </a>
                </div>
                <div id="navbar-menu-container" class="my-auto">
                    <div id="navbar-menu-desktop-content">
                        <?php
                        get_template_part( "templates/partials/navbar-menu-content" );
                        ?>
                    </div>
                    <div id="navbar-menu-mobile-container" class="my-auto">
                        <div id="menu-mobile-inner" class="flex">
                            <div id="mobile-menu-button" class="flex gap-2">
                                <span class="my-auto text-xl">
                                    Menu
                                </span>
                                <div id="tofu-burger" class="flex flex-col justify-center">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="navbar-menu-mobile-content" style="transform: translateY(-100%);opacity: 0;visibility: hidden;">
    <?php
    get_template_part( "templates/partials/navbar-menu-content" );
    ?>
</div>
