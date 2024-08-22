<style>
    .sidebar-hidden {
        display: none;
    }

    #sidebarToggleIcon {
        display: none;
        /* Hide initially */
        position: absolute;
        /* Adjust as needed */
        top: 10px;
        /* Adjust position */
        left: 10px;
        /* Adjust position */
        cursor: pointer;
        /* Optional: change cursor to pointer */
    }

    @media (max-width: 767.98px) {
        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #sidebarToggleIcon {
            order: 1;
        }

        .navbar-brand {
            order: 2;
            flex-grow: 1;
            text-align: center;
        }

        .navbar-toggler {
            order: 3;
        }

        .navbar-nav {
            order: 4;
            width: 100%;
            text-align: right;
            /* Align items to the right */
        }

        /* Ensure dropdown menu doesn't overlap with other elements */
        .navbar-nav .dropdown-menu {
            position: absolute;
            right: 0;
            left: auto;
        }
    }

    .btn-link {
        color: #112740;
        font-size: 1rem;
        font-weight: 400;
        text-decoration: none;
        background-color: transparent;
        border: none;
        padding: 0;
    }

    .btn-link:hover {
        color: #081f38;
        text-decoration: underline;
    }

    .btn-link:focus,
    .btn-link:active {
        box-shadow: none;
    }

    .accordion-indicator {
        margin-left: auto;
        transition: transform 0.2s;
    }

    .collapse.show+.accordion-indicator {
        transform: rotate(180deg);
        /* Rotate the indicator when expanded */
    }

    #sidebar {
        transition: width 0.3s ease, opacity 0.3s ease;     
    }

    .sidebar-hidden {
        width: 0;
        opacity: 0;
        overflow: hidden;
    }
</style>
