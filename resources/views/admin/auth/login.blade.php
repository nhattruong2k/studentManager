<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}} | Đăng nhập</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css?v=3.2.0') }}">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @notifyCss

    <script defer="" referrerpolicy="origin"
        src="/cdn-cgi/zaraz/s.js?z=JTdCJTIyZXhlY3V0ZWQlMjIlM0ElNUIlNUQlMkMlMjJ0JTIyJTNBJTIyQWRtaW5MVEUlMjAzJTIwJTdDJTIwTG9nJTIwaW4lMjIlMkMlMjJ4JTIyJTNBMC4xODk3NjQ4MTk1Njc5NDMzMyUyQyUyMnclMjIlM0ExNTM2JTJDJTIyaCUyMiUzQTg2NCUyQyUyMmolMjIlM0E3MzAlMkMlMjJlJTIyJTNBMTUzNiUyQyUyMmwlMjIlM0ElMjJodHRwcyUzQSUyRiUyRmFkbWlubHRlLmlvJTJGdGhlbWVzJTJGdjMlMkZwYWdlcyUyRmV4YW1wbGVzJTJGbG9naW4uaHRtbCUyMiUyQyUyMnIlMjIlM0ElMjJodHRwcyUzQSUyRiUyRnNlYXJjaC55YWhvby5jb20lMkYlMjIlMkMlMjJrJTIyJTNBMjQlMkMlMjJuJTIyJTNBJTIyVVRGLTglMjIlMkMlMjJvJTIyJTNBLTQyMCUyQyUyMnElMjIlM0ElNUIlNUQlN0Q=">
    </script>
    <script nonce="97ccf3c1-7a2a-4222-89a2-7d0aa9f65d85">
        try {
            (function(w, d) {
                ! function(ct, cu, cv, cw) {
                    ct[cv] = ct[cv] || {};
                    ct[cv].executed = [];
                    ct.zaraz = {
                        deferred: [],
                        listeners: []
                    };
                    ct.zaraz.q = [];
                    ct.zaraz._f = function(cx) {
                        return async function() {
                            var cy = Array.prototype.slice.call(arguments);
                            ct.zaraz.q.push({
                                m: cx,
                                a: cy
                            })
                        }
                    };
                    for (const cz of ["track", "set", "debug"]) ct.zaraz[cz] = ct.zaraz._f(cz);
                    ct.zaraz.init = () => {
                        var cA = cu.getElementsByTagName(cw)[0],
                            cB = cu.createElement(cw),
                            cC = cu.getElementsByTagName("title")[0];
                        cC && (ct[cv].t = cu.getElementsByTagName("title")[0].text);
                        ct[cv].x = Math.random();
                        ct[cv].w = ct.screen.width;
                        ct[cv].h = ct.screen.height;
                        ct[cv].j = ct.innerHeight;
                        ct[cv].e = ct.innerWidth;
                        ct[cv].l = ct.location.href;
                        ct[cv].r = cu.referrer;
                        ct[cv].k = ct.screen.colorDepth;
                        ct[cv].n = cu.characterSet;
                        ct[cv].o = (new Date).getTimezoneOffset();
                        if (ct.dataLayer)
                            for (const cG of Object.entries(Object.entries(dataLayer).reduce(((cH, cI) => ({
                                    ...cH[1],
                                    ...cI[1]
                                })), {}))) zaraz.set(cG[0], cG[1], {
                                scope: "page"
                            });
                        ct[cv].q = [];
                        for (; ct.zaraz.q.length;) {
                            const cJ = ct.zaraz.q.shift();
                            ct[cv].q.push(cJ)
                        }
                        cB.defer = !0;
                        for (const cK of [localStorage, sessionStorage]) Object.keys(cK || {}).filter((cM => cM
                            .startsWith("_zaraz_"))).forEach((cL => {
                            try {
                                ct[cv]["z_" + cL.slice(7)] = JSON.parse(cK.getItem(cL))
                            } catch {
                                ct[cv]["z_" + cL.slice(7)] = cK.getItem(cL)
                            }
                        }));
                        cB.referrerPolicy = "origin";
                        cB.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(ct[cv])));
                        cA.parentNode.insertBefore(cB, cA)
                    };
                    ["complete", "interactive"].includes(cu.readyState) ? zaraz.init() : ct.addEventListener(
                        "DOMContentLoaded", zaraz.init)
                }(w, d, "zarazData", "script");
            })(window, document)
        } catch (e) {
            throw fetch("/cdn-cgi/zaraz/t"), e;
        };
    </script>
</head>

<body class="login-page" cz-shortcut-listen="true" style="min-height: 495.6px;">
    <x-notify::notify />
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h2"><b>{{ trans('users.login_system') }}</b></a>
            </div>
            <div class="card-body">
                <form action="{{route('admin.post_login')}}" method="post" id="login_form">
                    @csrf
                    <div>
                        <div class="input-group">
                            <input type="email" class="form-control" name="email" id="email" placeholder="{{trans('users.email')}}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <label id="email-error" class="error" for="email" style="display: none"></label>
                    </div>
                    <div>
                        <div class="input-group mt-3">
                            <input type="password" class="form-control" name="password" id="password" placeholder="{{trans('users.password')}}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <label id="password-error" class="error" for="password" style="display: none"></label>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">{{ trans('users.remember_me') }}</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">{{ trans('users.login') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @notifyJs
    
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/dist/js/adminlte.min.js?v=3.2.0') }}"></script>

</body>

</html>
