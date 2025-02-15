
<x-front-layout title="2FA Challenge">
    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('two-factor.login') }}" method="post">
                        @csrf
                        <div class="Two Factor Code">
                            <div class="title">
                                <h3>Login Now</h3>
                                <p>You Must Enter The Code.</p>
                            </div>

                            @if ($errors->has('code'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <div class="form-group input-group">
                                <label for="reg-fn">2FA CODE</label>
                                <input class="form-control" type="text" name="code" id="reg-email" required>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->


</x-front-layout>