@section('title', '| 2人へのメッセージ')
<x-app-layout>
    <x-slot name="header" >
        
    </x-slot>
    
    <section id="top" class="w-screen h-screen bg-cover bg-center pt-auto pb-auto" style="background-image: url('/image/topsecstion_bg.jpg')" >
        <div class="md:flex w-full justify-center h-full">
            <div class="w-full sm:max-w-md my-16 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg md:ml-2">
                <form action="{{ route('message_confirm') }}" method="POST">
                    @csrf
                    <div class="w-full">
                        <label for="message_for_couple" class="text-lg">新郎新婦へメッセージを！</label>
                        @if (count($errors->message_confirm) > 0)
                            <div>           
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->message_confirm->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="w-full mt-5">
                            <textarea class="textarea textarea-bordered dark:bg-white w-full" name="message_for_couple" id="" cols="30" rows="15">{{ old('message_for_couple') }}</textarea>
                        </div>
                        <div class="w-full flex justify-center mt-2">
                            <button type="submit" class="btn btn-active btn-ghos">送信する</button>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>