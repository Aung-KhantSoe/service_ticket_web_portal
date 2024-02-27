@section('header')
@include('templates.header')
@show
@section('sidebar')
@include('templates.sidebar')
@show

<div class="page-body">
    <!-- Container-fluid starts-->
    <div class="container-fluid support-ticket">
      <div class="row">
        <div class="col-sm-12">
          @if(session()->has('success'))
            <div class="alert alert-primary dark alert-dismissible fade show" role="alert"><strong>Success ! </strong> {{session('success')}}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <div class="card">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <h5>Product List</h5>
              <a class="btn btn-primary" href="{{asset('/products/create')}}">Create Product</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="display text-center" id="basic-6">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Service Ticket Price</th>
                      <th>Change Request Price</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                    <tr>

                        <td>{{$product->name}}</td>
                        <td>{{$product->price->service_ticket_price}}</td>
                        <td>{{$product->price->change_request_price}}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn text-success"><i class="icofont icofont-ui-edit"></i></a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure you want to delete this product?')" type="submit" class="btn btn-danger btn-block"><i class="icofont icofont-ui-delete"></i></button>
                                </form>

                            </div>
                        </td>
                      </tr>
                    @endforeach


                  </tbody>
                  <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Service Ticket Price</th>
                        <th>Change Request Price</th>
                        <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>
@section('footer')
@include('templates.footer')
@show
