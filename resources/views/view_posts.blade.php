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
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Handle</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($post as $each)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$each->title}}</td>
                                <td>{{$each->post}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="p-6 bg-white border-b border-gray-200 m-2">
                                                        <div class="btn-success">
                                                            @if(session('msg'))
                                                                {{session('msg')}}
                                                            @endif
                                                        </div>
                                                        <form action="/update_posts" method="post">
                                                            @csrf
                                                            <input type="text" hidden value="{{$each->id}}" name="id">
                                                            <div class="mb-3 mt-3">
                                                                <label for="email" class="form-label">Title:</label>
                                                                <input type="text" value="{{$each->title}}" class="form-control" id="pwd" placeholder="Enter name" name="title">
                                                            </div>
                                                            <div class="mb-3 mt-3">
                                                                <label for="email" class="form-label">Posts:</label>
                                                                <textarea name="post" id="" rows="2" class="form-control">{{$each->post}}</textarea>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <Button class="btn btn-danger"><a href="/delete/{{$each->id}}" class="text-white">Delete</a></Button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
