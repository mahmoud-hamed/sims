<div class="modal fade text-right" id="accept" tabindex="-1" role="dialog" aria-labelledby="acceptLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="acceptLabel">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <i class="tim-icons icon-simple-remove"></i>
                    </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">

                <form style="display: inline; width:100%" action="{{ route('assign.order', $order->id) }}" method="post"
                    class="text-center" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                  
                    <div class="group-btn d-flex w-100" style="justify-content:space-around;">
                        <button style="width:35%" class="btn btn-outline-success">اضافه</button>
                        <button style="width:35%" type="button" class="btn btn-outline-danger"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
