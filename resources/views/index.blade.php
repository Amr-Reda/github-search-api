<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Github search</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            @if ($error ?? '')
                <div class="alert alert-danger">
                    {{$error}}
                </div>
            @endif
            <div class="my-5 d-flex justify-content-center">
                <form class="form-inline" id="searchForm" action="/" method="POST">
                    @csrf
                    <div class="form-group mx-sm-3">
                        <input type="text" class="form-control" id="search" value="{{$search ?? ''}}" name="search" placeholder="Search for tech" required>
                        @if (isset($sort))
                            <select class="custom-select ml-2" name="sort">
                                <option value=""  {{ $sort  === '' ? 'selected' : '' }}>Sort: Best match</option>
                                <option value="stars" {{ $sort  === 'stars' ? 'selected' : '' }}>Sort: Stars</option>
                                <option value="forks" {{ $sort  === 'forks' ? 'selected' : '' }}>Sort: Forks</option>
                            </select>
                        @else
                            <select class="custom-select ml-2" name="sort">
                                <option value=""  selected>Sort: Best match</option>
                                <option value="stars">Sort: Stars</option>
                                <option value="forks">Sort: Forks</option>
                            </select>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="d-flex justify-content-center my-3">
                <h3>Results</h3>
            </div>

            <div class="container h-100" id="results">
                @foreach ($items ?? [] as $item)
                    <div class="row h-100 justify-content-center align-items-center">
                        <div class="card w-75 my-3">
                            <div class="card-body">
                                <h5 class="card-title"><b>Repository Name: </b> {{$item['name']}}</h5>
                                <p class="card-text"><b>Owner: </b> {{$item['owner']['login']}}</p>
                                <p class="card-text"><b>Stars: </b> {{$item['stargazers_count']}}</p>
                                <p class="card-text"><b>Forks: </b> {{$item['forks']}}</p>
                                <form id="{{$item['id']}}" onsubmit="handleOwnerInfo(event)">
                                    <input type="hidden" value="{{$item['owner']['url']}}">
                                    <button class="btn btn-success float-right">Show owner stats</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ownerInfoModel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="ownerInfoModelLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ownerInfoModelLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="followers" class="col-sm-2 col-form-label col-form-label-sm">Followers</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control form-control-sm" id="followers" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="following" class="col-sm-2 col-form-label col-form-label-sm">Following</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control form-control-sm" id="following" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="repositories" class="col-sm-2 col-form-label col-form-label-sm">Repositories</label>
                            <div class="col-sm-5">
                              <input type="text" class="form-control form-control-sm" id="repositories" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
