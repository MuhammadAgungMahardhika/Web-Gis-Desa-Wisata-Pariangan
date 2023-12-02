<div class="sidebar-menu">
    <?= $this->include('layout/sidebar_detail'); ?>
    <ul class="menu">
        <li class="sidebar-item <?= current_url() === base_url('list_object') ? 'active' : ''; ?>" id="indexMenu">
            <a href="<?= base_url('list_object') ?>" class='sidebar-link'>
                <i class="iconify" data-icon="ant-design:home-filled" data-width="25" data-height="25"></i>
                <span>Home</span>
            </a>
        </li>

        <?php if (current_url() == base_url('list_object')) : ?>

            <li class="sidebar-item  has-sub" id="uniqueMenu">
                <a href="" class='sidebar-link'>
                    <i class="iconify" data-icon="mdi:local-attraction" data-width="25" data-height="25"></i>
                    <span>Unique Attraction</span>
                </a>
                <ul class="submenu">
                    <!-- Pariangan mangrove Menu -->
                    <div class="sidebar-item " id="graveMenu">
                        <a class='sidebar-link' onclick="showObject('atraction','01')" style="cursor: pointer;">
                            <i class="iconify" data-icon="mdi:grave-stone" data-width="25" data-height="25"></i>
                            <span>Long Grave of Tantejo Gurhano</span>
                        </a>
                    </div>

                    <!-- Stone Menu -->
                    <li class="sidebar-item" id="stoneMenu">
                        <a class='sidebar-link' onclick="showStone()" style="cursor: pointer;">
                            <i class="iconify" data-icon="game-icons:rock" data-width="25" data-height="25"></i>
                            <span>Lantak Tigo Stone</span>
                        </a>
                    </li>

                    <!-- Masjid Islah -->
                    <li class="sidebar-item" id="mosqueMenu">
                        <a class='sidebar-link' onclick="showObject('atraction','05')" style="cursor: pointer;">
                            <i class="iconify" data-icon="mdi:mosque" data-width="25" data-height="25"></i>
                            <span>Islah Mosque</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item" id="ordinaryMenu">
                <a class='sidebar-link' onclick="showOrdinary()" style="cursor: pointer;">
                    <i class="iconify" data-icon="maki:attraction" data-width="25" data-height="25"></i>
                    <span>Ordinary Atraction</span>
                </a>
            </li>
            <!-- Event Menu -->
            <li class="sidebar-item" id="eventMenu">
                <a class='sidebar-link' onclick="showEvent()" style="cursor: pointer;">
                    <i class="iconify" data-icon="material-symbols:event" data-width="25" data-height="25"></i>
                    <span> Event </span>
                </a>
            </li>

        <?php endif; ?>

        <!-- Package Menu -->
        <li class="sidebar-item <?= current_url() == base_url('package') ? 'active' : '' ?>" id="packageMenu">
            <a href="<?= base_url('package') ?>" class="sidebar-link">
                <i class="iconify" data-icon="material-symbols:package-outline-rounded" data-width="25" data-height="25"></i>
                <span> Tourism Package </span>
            </a>

        </li>
        <!-- Product Menu -->
        <li class="sidebar-item  has-sub <?= (current_url() == base_url('product/culinary') || current_url() == base_url('product/souvenir')) ? 'active' : '' ?>" id="productMenu">
            <a href="" class='sidebar-link'>
                <i class="iconify" data-icon="emojione-monotone:shopping-cart" data-width="25" data-height="25"></i>
                <span>Product</span>
            </a>
            <ul class="submenu <?= (current_url() == base_url('product/culinary') || current_url() == base_url('product/souvenir')) ? 'active' : '' ?>">
                <li class="submenu-item sidebar-link <?= (current_url() == base_url('product/culinary')) ? 'active' : '' ?>">
                    <i class="iconify" data-icon="fluent:food-20-regular" data-width="25" data-height="25"></i>
                    <a role="button" href="<?= base_url('product/culinary') ?>">Culinary</a>
                </li>
                <li class="submenu-item sidebar-link  <?= (current_url() == base_url('product/souvenir')) ? 'active' : '' ?>">
                    <i class="iconify" data-icon="dashicons:products" data-width="25" data-height="25"></i>
                    <a role="button" href="<?= base_url('product/souvenir') ?>">Souvenir</a>
                </li>
            </ul>
        </li>
        <!-- Admin Menu -->
        <?php if (in_groups('admin')) : ?>
            <li class="sidebar-title">Admin</li>
            <li class="sidebar-item <?= current_url() == base_url('dashboard') ? 'active' : ''; ?>" id="indexMenu">
                <a href="<?= base_url('dashboard') ?>" class='sidebar-link'>
                    <i class="iconify" data-icon="clarity:home-solid" data-width="25" data-height="25"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item  has-sub 
            <?= (current_url() == base_url('manage_users') || current_url() == base_url('manage_pariangan') || current_url() == base_url('manage_atraction') || current_url() == base_url('manage_package') || current_url() == base_url('manage_product') || current_url() == base_url('manage_event') || current_url() == base_url('manage_culinary_place') || current_url() == base_url('manage_souvenir_place') || current_url() == base_url('manage_worship_place') || current_url() == base_url('manage_facility') || current_url() == base_url('manage_reservation') || current_url() == base_url('manage_homestay')) ? 'active' : '' ?>" id="adminMenu">
                <a href="" class='sidebar-link'>
                    <i class="iconify" data-icon="fa6-solid:gear" data-width="25" data-height="25"></i>
                    <span>Manage menu</span>
                </a>
                <ul class="submenu 
                <?php if (current_url() == base_url('manage_users') || current_url() == base_url('manage_pariangan') || current_url() == base_url('manage_atraction') || current_url() == base_url('manage_package') || current_url() == base_url('manage_product') || current_url() == base_url('manage_event') || current_url() == base_url('manage_culinary_place') || current_url() == base_url('manage_souvenir_place') || current_url() == base_url('manage_worship_place') || current_url() == base_url('manage_facility') || current_url() == base_url('manage_reservation') || current_url() == base_url('manage_homestay')) : echo 'active';
                endif; ?>">
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_users')) echo 'active'; ?>">
                        <i class="iconify" data-icon="clarity:users-solid" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_users') ?>">Users & Admins</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_reservation')) echo 'active'; ?>">
                        <i class="iconify" data-icon="material-symbols:order-play-outline" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_reservation') ?>">Booking info</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_pariangan')) echo 'active'; ?>">
                        <i class="iconify" data-icon="fontisto:holiday-village" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_pariangan') ?>">Village</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_atraction')) echo 'active'; ?>">
                        <i class="iconify" data-icon="ant-design:star-filled" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_atraction') ?>">Uniqe Atraction</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_package')) echo 'active'; ?>">
                        <i class="iconify" data-icon="material-symbols:package-outline-rounded" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_package') ?>">Package</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_event')) echo 'active'; ?>">
                        <i class="iconify" data-icon="material-symbols:event-note" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_event') ?>">Event</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_product')) echo 'active'; ?>">
                        <i class="iconify" data-icon="emojione-monotone:shopping-cart" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_product') ?>">Product</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_souvenir_place')) echo 'active'; ?>">
                        <i class="iconify" data-icon="typcn:gift" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_souvenir_place') ?>">Souvenir</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_culinary_place')) echo 'active'; ?>">
                        <i class="iconify" data-icon="dashicons:food" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_culinary_place') ?>">Culinary</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_worship_place')) echo 'active'; ?>">
                        <i class="iconify" data-icon="mdi:mosque" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_worship_place') ?>">Worship</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_facility')) echo 'active'; ?>">
                        <i class="iconify" data-icon="mdi:tools" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_facility') ?>">Facility</a>
                    </li>
                    <li class="submenu-item sidebar-link  <?php if (current_url() == base_url('manage_homestay')) echo 'active'; ?>">
                        <i class="iconify" data-icon="mdi:tools" data-width="25" data-height="25"></i>
                        <a role="button" href="<?= base_url('manage_homestay') ?>">Homestay</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

    </ul>
</div>