
@guest
@else
    <nav id="sidebar" class="bg-light border-right" style="width: 20%; min-width: 200px; height: 100vh;">
        <div class="card h-100">
            <div class="sidebar-header d-flex justify-content-between align-items-center p-3">
                <h4>Sidebar</h4>
                <!-- Collapse Button with Custom SVG -->
                <button id="sidebarCollapse" class="btn" style="background: transparent; border: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="#000000" <!-- Adjust color as needed -->
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        >
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                        <line x1="9" y1="3" x2="9" y2="21" />
                    </svg>
                </button>
            </div>
            <div class="card-body p-3">
                <div id="sidebarcontain">
                    <!-- Sidebar content will be loaded here -->
                </div>
            </div>
            {{-- <button id="fetchData">Fetch Menu Data</button>
            <pre id="dataOutput"></pre> --}}
        </div>
    </nav>
@endguest
@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/api/menus', // The endpoint for fetching menu data
                method: 'GET',
                success: function(data) {
                    let html = '';
                    data.forEach(section => {
                        html += `<h5 class="sidebar-header text-muted">${section.DisplayMenu}</h5>`;
                        html += '<ul class="list-unstyled components">';
                        section.submenu.forEach(item => {
                            if (item.IsAccordion) {
                                html += `<li>
                                            <a href="#${item.DisplayMenu.replace(/\s+/g, '-').toLowerCase()}" class="ps-2 btn btn-link dropdown-toggle d-flex align-items-center" data-toggle="collapse" aria-expanded="false">
                                                ${item.DisplayMenu}
                                                <span class="accordion-indicator ml-auto">
                                                </span>
                                            </a>
                                            <ul class="collapse list-unstyled" id="${item.DisplayMenu.replace(/\s+/g, '-').toLowerCase()}">`;
                                item.submenu.forEach(submenu => {
                                    html += `<li>
                                                <a href="${submenu.UrlMenu}" class="btn btn-link ps-3">${submenu.DisplayMenu}</a>
                                            </li>`;
                                });
                                html += '</ul></li>';
                            } else {
                                html += `<li>
                                            <a href="${item.UrlMenu}" class="btn btn-link ps-2">${item.DisplayMenu}</a>
                                        </li>`;
                            }
                        });
                        html += '</ul>';
                    });
                    $('#sidebarcontain').html(html);
                },
                error: function(xhr) {
                    console.error('Error fetching menu data.');
                }
            });
        });
    </script>
@endpush
