<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            z-index: 1000;
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
            overflow-y: auto;
        }

        #content {
            margin-left: 250px;
            transition: all 0.3s;
        }

        #sidebar.active {
            margin-left: -250px;
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
                <a href="#">Profile</a>
            </li>
            <li>
                <a href="#">Settings</a>
            </li>
        </ul>
    </div>

    <!-- Page Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#content').toggleClass('active');
            });

        });
    </script>
    <script>
        $(function(){
        $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            });
        $(function(){
            $('#provinsi').on('change', function(){
                let id_provinsi = $('#provinsi').val();

                $.ajax({
                    type : 'POST',
                    url : "{{route('getkabupaten')}}",
                    data : {id_provinsi:id_provinsi},
                    cache : false,

                    success: function(msg){
                        $('#kabupaten').html(msg);
                    },
                    error: function(data){
                        console.log('error:', data)
                    },


                    })
                })
            })
        });
    </script>
</body>
</html>
