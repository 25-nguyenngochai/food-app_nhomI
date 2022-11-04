<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <br>
            <a href="{{ url('/index') }}">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus />
            </div>

            <!-- Email -->
            <div class="mt-3">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"/>
            </div>

             <!-- Phone -->
             <div class="mt-3">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')"/>
            </div>

             <!-- Address -->
             <div class="mt-3">
                <x-label for="address" :value="__('Address')" />

                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"/>
            </div>

            <!-- Password -->
            <div class="mt-3">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                 autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-3">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation"/>
            </div>

            <!-- Avata -->
            <div class="mt-3">
                <x-label for="avata" :value="__('Avata')" />

                <x-input id="avata" class="block mt-1 w-full" type="file" name="avata" :value="old('avata')"/>
                <br>
                <img id="hinh" alt="" style="width:150px"/>
                <x-input type="hidden" value="user.jpg" name="value_avata"/>
            </div>

            <script>
                const avata = document.querySelector('#avata');
                const hinh = document.querySelector('#hinh');
                avata.onchange = evt => {
                    const [file] = avata.files
                    if (file) {
                        hinh.src = URL.createObjectURL(file)
                    }
                }
            </script>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
