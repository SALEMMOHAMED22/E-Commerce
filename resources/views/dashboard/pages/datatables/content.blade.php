<button class="btn btn-outline-primary" data-toggle="modal" data-target="#contentPage-{{ $page->id }}">
    <i class="fa fa-expand"></i> {{ __('dashboard.fullscreen') }}
</button>

 <!-- Fullscreen Modal -->
 <div class="modal fade" id="contentPage-{{ $page->id }}" tabindex="-1" role="dialog"
    aria-labelledby="fullscreenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fullscreenModalLabel">{{ __('dashboard.fullscreen') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="fullscreenCarousel" class="" data-ride="carousel">
                    <div class="active">
                        <p>{!! $page->getTranslation('content' , app()->getLocale()) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
