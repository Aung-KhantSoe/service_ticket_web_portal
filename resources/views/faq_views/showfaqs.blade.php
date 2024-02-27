@section('header')
@include('templates.header')
@show
@section('sidebar')
@include('templates.sidebar')
@show

<div class="page-body">
     <!-- Container-fluid starts-->
     <div class="container-fluid">
        <div class="faq-wrap">
          <div class="row">
            <div class="col-xl-4 xl-100 box-col-12">
              <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5>Faq List</h5>
                    <a class="btn btn-primary" href="{{asset('/faqs/create')}}">Create Faq</a>
                  </div>
              </div>
            </div>
            <div class="col-12">
                @if(session()->has('success'))
                    <div class="alert alert-primary dark alert-dismissible fade show" role="alert"><strong>Success ! </strong> {{session('success')}}
                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @foreach ($products as $product)
                @php
                    $faqs = $product->faqs;
                @endphp
                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                      <h5>{{ $product->name }}</h5>
                    </div>
                    <div class="card-body">
                      <div>
                        <table class="table table-striped" >
                          <thead>
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($faqs as $faq)
                            <tr>

                                <td>{{$faq->question}}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('faqs.edit', $faq->id) }}" class="btn text-success"><i class="icofont icofont-ui-edit"></i></a>
                                        <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Are you sure you want to delete this faq?')" type="submit" class="btn btn-danger btn-block"><i class="icofont icofont-ui-delete"></i></button>
                                        </form>

                                    </div>
                                </td>
                              </tr>
                            @endforeach


                          </tbody>

                        </table>
                      </div>
                    </div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->
  </div>
@section('footer')
@include('templates.footer')
@show
