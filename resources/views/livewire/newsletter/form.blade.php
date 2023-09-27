<div class="mb-4">
    {{-- 提示 用户 订阅 成功 --}}
    <x-ui.alerts />

    {{-- 这个 不需要 定义action --}}
    <form wire:submit.prevent='formSubmit'>
        {{-- max-w-4xl：设置input的width --}}
        <div class=" container max-w-4xl mx-auto text-left">
            {{-- Name --}}

            <div>
                <x-label for='name' value="{{ __('Name') }}" class="font-bold text-white" />
                <x-input name='name' wire:model='name' id="name" class="block w-full mt-1" type='text' />
                <x-input-error for='name' class="mt-2" />
            </div>

            {{-- Email --}}

            <div class="mt-3">
                <x-label for='email' value="{{ __('Email') }}" class="font-bold text-white" />
                <x-input name='email' wire:model='email' id="email" class="block w-full mt-1" type='text' />
                <x-input-error for='email' class="mt-2" />
            </div>

            {{-- Submit Button --}}

            <div class="mt-3">
                <x-button class="mt-12">
                    {{ __('Subscribe') }}
                </x-button>

            </div>
        </div>
    </form>

</div>
