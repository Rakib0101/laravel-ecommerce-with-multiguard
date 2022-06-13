<!-- Add to Cart Product Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-4">

                        <div class="card" style="width: 24rem;">
                            <img src=" " class="card-img-top" alt="..." style="height: 150px; width: 200px;"
                                id="pimage">
                        </div>

                    </div><!-- // end col md -->


                    <div class="col-md-4">

                        <ul class="list-group">
                            <li class="list-group-item">Product Price: <strong class="text-danger">$<span
                                        id="pprice"></span></strong>
                                <del id="oldprice">$</del>
                            </li>
                            <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                            <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                            <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                            <li class="list-group-item">Stock: <span class="badge badge-pill badge-success"
                                    id="aviable" style="background: green; color: white;"></span>
                                <span class="badge badge-pill badge-danger" id="stockout"
                                    style="background: red; color: white;"></span>
                            </li>
                        </ul>

                    </div><!-- // end col md -->


                    <div class="col-md-4">

                        <div class="form-group" id="sizeArea">
                            <label for="size">Choose Size</label>
                            <select class="form-control" id="size" name="size">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div> <!-- // end form group -->

                        <div class="form-group" id="sizeArea">
                            <label for="color">Choose Color</label>
                            <select class="form-control" id="color" name="color">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div> <!-- // end form group -->

                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" id="qty" value="1" min="1">
                        </div> <!-- // end form group -->

                        <input type="hidden" id="product_id" value="{{$product->id}}">
                        <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to
                            Cart</button>

                    </div><!-- // end col md -->


                </div> <!-- // end row -->



            </div> <!-- // end modal Body -->

        </div>
    </div>
</div>
<!-- End Add to Cart Product Modal -->