<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 200px;
            z-index: 1000;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
            overflow-y: auto;
        }

        #content {
            margin-left: 200px; /* Set margin-left to the width of the sidebar */
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -200px; /* Adjust to match sidebar width */
        }

        #content.active {
            margin-left: 0;
        }

        #sidebarCollapse {
            position: absolute;
            top: 0;
            right: -45px;
            width: 40px;
            height: 40px;
            background: #343a40;
            color: #fff;
            border-radius: 3px;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
            transition: all 0.3s;
        }

        #sidebarCollapse:hover {
            background: #232931;
        }

        select[name=status] {
            width: 100px;
            padding: 5px;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="p-4" id="sidebar">
        <div class="sidebar-header">
            <h3>Markotol</h3>
        </div>

        <ul class="list-unstyled components">
            <p>Main Menu</p>
            <li>
                <a href="#">Home</a>
            </li>
            <li>
                <a href="/lokasi">Lokasi</a>
            </li>
            <li>
                <a href="/barang">Barang</a>
            </li>
            <li>
                <a href="/catalog">Catalog</a>
            </li>
        </ul>
    </div>

    <!-- Page Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                {{-- <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button> --}}
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            @yield('content')
        </div>
    </div>

    <script>
        document.getElementById('sidebarCollapse').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('content').classList.toggle('active');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(function() {
                $('#provinsi').on('change', function() {
                    let id_provinsi = $('#provinsi').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('getkabupaten') }}",
                        data: {
                            id_provinsi: id_provinsi
                        },
                        cache: false,

                        success: function(msg) {
                            $('#kabupaten').html(msg);
                        },
                        error: function(data) {
                            console.log('error:', data)
                        },


                    })
                })
            })
        });
    </script>

    {{-- script form status --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Tanggapi perubahan pada dropdown
            $('select[name=status]').change(function() {
                var selectedColor = $(this).find('option:selected').css('background-color');
                $(this).css('background-color', selectedColor);
            });
        });
    </script>

</body>

</html>
