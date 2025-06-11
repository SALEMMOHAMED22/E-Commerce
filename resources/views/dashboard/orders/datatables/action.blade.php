<div class="form-group">
    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">

        <a href="{{ route('dashboard.orders.show', $row->id) }}" class="btn btn-outline-info">
            {{ __('dashboard.show') }} <i class="la la-edit"></i>
        </a>

        <button  order-id = "{{ $row->id }}" class="delete_confirm_btn  btn btn-outline-danger">
            {{ __('dashboard.delete') }} <i class="la la-trash"></i>
        </button>    

    </div>
    
</div>

