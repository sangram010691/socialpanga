<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Hi,{{ Auth::user()->name }} You're logged in!
                </div>
                <div class="p-6 bg-white border-b border-gray-200 m-2">
                    <div class="btn-success">
                        @if(session('msg'))
                            {{session('msg')}}
                        @endif
                    </div>
                    <h3>create a post</h3>
                    <a href="/view-posts">View All Posts</a>
                    <form action="/posts" method="post">
                        @csrf
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Title:</label>
                            <input type="text" class="form-control" id="pwd" placeholder="Enter name" name="title">
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Posts:</label>
                            <textarea name="post" id="" rows="3" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
