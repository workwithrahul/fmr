<!-- Delete Client Record Modal-->
<div id="delete_record" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="fullwidth">
                    <div class="row align-items-center">
                        <div class="col-sm-12 popinput">
                            <strong class="delete_record_text">Are you sure want to do this?</strong>
                            <a class="btn primarybtn shortbtn client_del_yes">Yes</a>
                            <a class="btn primarybtn shortbtn cancelbtn" data-dismiss="modal">No</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  Client Cancel Button Modal-->
<div id="cancel_button" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form class="fullwidth">
                    <div class="row align-items-center">
                        <div class="col-sm-12 popinput">
                            <strong class="delete_record_text"> Do you want to discard changes?</strong>
                            <a class="btn primarybtn shortbtn cancel_button_yes">Yes</a>
                            <a class="btn primarybtn shortbtn cancelbtn" data-dismiss="modal">No</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Contact Email Field Record Modal-->
<div id="contact_field_record" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="cms_contact_email" method="POST" enctype="multipart/form-data" class="fullwidth">
                    @csrf
                    <div class="row align-items-center popformrow">
                        <div class="col-sm-4 poplabel">Email</div>
                        <div class="col-sm-8 popinput">
                            <input class="contact_email_field {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" type="email" placeholder="Email" />
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 clientbtn">
                            <input type="button" id="email_sbmt_btn" class="btn primarybtn" value="Save">
                            <input type="reset" class="btn primarybtn cancelbtn" data-dismiss="modal" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Contact Category Field Record Modal-->
<div id="contact_cat_field_record" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <form id="cms_contact_cat" method="POST" enctype="multipart/form-data" class="fullwidth">
                    @csrf
                    <div class="row align-items-center popformrow">
                        <div class="col-sm-4 poplabel">Category</div>
                        <div class="col-sm-8 popinput">
                            <input class="contact_cat_field" name="category" type="text" placeholder="Category" />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 clientbtn">
                            <input type="button" id="cat_sbmt_btn" class="btn primarybtn" value="Save">
                            <input type="reset" class="btn primarybtn cancelbtn" data-dismiss="modal" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Manage Field Record Modal-->
<div id="manage_fields_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal">X</button>
            <div class="modal-body">
                <form id="cms_manage_fields" action ="{{ url('admin/cms/manage/field/save') }}" method="POST" enctype="multipart/form-data" class="fullwidth">
                    @csrf
					<input type="hidden" name="field_tab" id="field_tab" value="">
                    <div class="row align-items-center popformrow">
                        <div class="col-sm-4 poplabel">Field Name</div>
                        <div class="col-sm-8 popinput">
                            <input name="field_label" type="text" placeholder="Name" />
                        </div>
                    </div>
                    <div class="row align-items-center popformrow">
                        <div class="col-sm-4 poplabel">Field Type</div>
                        <div class="col-sm-8 popinput">
                            <select class="field_type" name="field_type">
                                <option selected disabled>Select Type</option>
                                <option value="range">Range</option>
                                <option value="boolean">Yes/No</option>
                                <option value="select">Select</option>
                                <option value="textarea">Textarea</option>
                            </select>
                        </div>
                    </div>
                    <div id="field_type_option"></div>
                    <div class="row align-items-center">
                        <div class="col-sm-4 poplabel"></div>
                        <div class="col-sm-8 popinput">
                            <input id="cms_manage_btn" type="button" class="btn primarybtn shortbtn" value="Save" />
                            <a data-dismiss="modal" class="btn primarybtn shortbtn cancelbtn">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>