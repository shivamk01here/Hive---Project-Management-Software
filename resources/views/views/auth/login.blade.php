

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Task Manager </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>


#password {
  padding-right: 40px; /* To provide space for the icon */
}

.toggle-password {
  position: absolute;
  top: 20px;
  right: 15px;
  transform: translateY(-50%);
  cursor: pointer;
}

.text-left{
    text-align:left;
}

.login_content {
    margin: 0 auto;
    padding: 25px 0 0;
    position: relative;
    text-align: center;
    text-shadow: 0 1px 0 #fff;
    min-width: 280px;
}

.login_wrapper {
    right: 0px;
    margin: 0px auto;
    margin-top: 5%;
  
    position: relative;
}
.login_content h1 {
    font: normal 25px Helvetica, Arial, sans-serif;
    letter-spacing: -0.05em;
    line-height: 20px;
    margin: 10px 0 30px;
}

.font12 {
    font-size: 12px;
}

  </style>
  
</head>

<body>
<div class="login_wrapper">
    <section class="login_content">
    <div class="container mt-5">
        <main class="login-form">
            <div class="cotainer">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card">
                            <h3 class="card-header text-center">Login</h3>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login.custom') }}">
                                    @csrf
                                    <div class="form-group mb-3 text-left">
                                        <input type="text" placeholder="Email" id="email" class="form-control" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <span class="text-danger font12">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3 text-left" style="position:relative">
                                        <input type="password" placeholder="Password" id="password" class="form-control" name="password" value="{{ old('password') }}">
                                        <span class="toggle-password">👁️</span>
                                        @if ($errors->has('password'))
                                        <span class="text-danger font12">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="d-grid mx-auto">
                                        <button type="submit" class="btn btn-dark btn-block">Signin</button>
                                    </div>
                                    @if($errors->has('login'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('login') }}
                                        </div>
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </section>
</div>
</body>
</html>
<script>
    $(document).ready(function() {
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>