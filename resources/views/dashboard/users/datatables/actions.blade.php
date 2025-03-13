<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        {{-- <a href="" class="edit_coupon btn btn-outline-success">
            {{ __('dashboard.edit') }} <i class="la la-edit"></i>
        </a> --}}


        <button user-id="{{ $user->id }}"  type="button" class="btn btn-outline-info status_btn">
            {{ __('dashboard.status_management') }} <i class="la la-stop"></i>
        </button>

        {{-- <a href="" class="btn btn-outline-primary ">
            {{ __('dashboard.show_product') }} <i class="la la-eye"></i>
        </a> --}}


        <button id="btnGroupDrop2" user-id="{{ $user->id }}" type="button"
            class="delete_confirm_btn btn btn-outline-danger">
            {{ __('dashboard.delete') }}<i class="la la-trash"></i>
        </button>


    </div>
</div>