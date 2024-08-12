<form role="search" method="get" id="header__search" class="header__search" action="<?php echo home_url( '/' ); ?>">
    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="O que você procura?" />
    <label for="searchsubmit">
        <svg width="29" height="29" viewBox="0 0 29 29" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28.7101 26.2901L22.2101 19.7901H22.1401C24.1435 17.4278 25.156 14.3824 24.9656 11.2908C24.7752 8.19922 23.3968 5.30099 21.1186 3.20238C18.8405 1.10377 15.8391 -0.0326474 12.7423 0.0308444C9.64552 0.0943363 6.69322 1.35282 4.503 3.54304C2.31278 5.73326 1.0543 8.68556 0.990805 11.7823C0.927314 14.8791 2.06373 17.8805 4.16234 20.1587C6.26095 22.4368 9.15918 23.8153 12.2508 24.0056C15.3424 24.196 18.3878 23.1836 20.7501 21.1801C20.7501 21.1801 20.7501 21.2301 20.7501 21.2501L27.2501 27.7501C27.343 27.8438 27.4536 27.9182 27.5755 27.969C27.6973 28.0198 27.828 28.0459 27.9601 28.0459C28.0921 28.0459 28.2228 28.0198 28.3446 27.969C28.4665 27.9182 28.5771 27.8438 28.6701 27.7501C28.7726 27.6593 28.8554 27.5485 28.9133 27.4244C28.9712 27.3003 29.003 27.1657 29.0068 27.0288C29.0105 26.8919 28.9861 26.7557 28.9351 26.6286C28.884 26.5016 28.8075 26.3863 28.7101 26.2901ZM13.0001 22.0001C11.0222 22.0001 9.08884 21.4136 7.44435 20.3148C5.79986 19.216 4.51814 17.6542 3.76126 15.8269C3.00438 13.9997 2.80635 11.989 3.1922 10.0492C3.57805 8.10938 4.53046 6.32755 5.92899 4.92903C7.32751 3.5305 9.10934 2.57809 11.0492 2.19224C12.989 1.80639 14.9996 2.00442 16.8269 2.7613C18.6542 3.51818 20.2159 4.7999 21.3148 6.44439C22.4136 8.08888 23.0001 10.0223 23.0001 12.0001C23.0001 13.3133 22.7414 14.6137 22.2389 15.8269C21.7363 17.0402 20.9997 18.1426 20.0711 19.0712C19.1425 19.9997 18.0401 20.7363 16.8269 21.2389C15.6136 21.7414 14.3133 22.0001 13.0001 22.0001Z" fill="white"/></svg>
        <input type="submit" id="searchsubmit" value="<?php echo esc_attr__('Search'); ?>" />
    </label>
</form> 