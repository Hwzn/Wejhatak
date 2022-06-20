<div class="modal fade" id="editModolad_ConsultationType" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                            id="exampleModalLabel">
                            {{ trans('consulationtype_trans.edit_ConsultionType') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="alert alert-danger print-error-msg" style="display:none">
                                    <ul></ul>
                         </div>
                        <!-- add_form -->
                        <form action="{{route('update_consultationtype')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="Name"
                                           class="mr-sm-2">{{ trans('consulationtype_trans.name_ar') }}
                                        :</label>
                                    <input id="Name" type="text" name="name_ar" class="form-control Addservice_Namear">
                                    <input  type="hidden" name="consultationtype_id" class="form-control Addcar_type">

                                    
                                </div>
                                <div class="col">
                                    <label for="Name_en"
                                           class="mr-sm-2">{{ trans('consulationtype_trans.name_en') }}
                                        :</label>
                                    <input type="text" class="form-control"  id="addGrad_Name" name="name_en"
                                      class="form-control Addservice_Nameen">
                                </div>
                                
                            </div>
                           
                            <div class="form-group">
                               
                            </div>
                            <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{  trans('consulationtype_trans.Close') }}</button>
                        <button  type="edit"
                                class="btn btn-success">{{ trans('consulationtype_trans.submit') }}</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>