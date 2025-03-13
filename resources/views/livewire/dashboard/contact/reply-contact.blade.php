<div>
    <!-- Modal -->
    <div class="modal fade" id="replyContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <img src="{{ asset($setting->logo) }}" alt="Logo" class="mr-2" width="40">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-envelope"></i> {{ __('dashboard.reply_contact') }}
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="replyContact" class="form">
                        <input type="hidden" wire:model="id" id="contactId">

                        <div class="form-group">
                            <label for="userEmail"><i class="fas fa-envelope"></i> {{ __('dashboard.email') }}</label>
                            <input readonly wire:model="email" id="userEmail" class="form-control bg-light border-0" type="email">
                        </div>

                        <div class="form-group">
                            <label for="contactSubject"><i class="fas fa-tag"></i> {{ __('dashboard.subject') }}</label>
                            <input readonly wire:model="subject" id="contactSubject" class="form-control bg-light border-0" type="text">
                        </div>

                        <div class="form-group">
                            <label for="replyMessage"><i class="fas fa-comment-dots"></i> {{ __('dashboard.reply_message') }}</label>
                            <textarea rows="4" wire:model="replyMessage" id="replyMessage" class="form-control border-primary"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                <i class="fas fa-times"></i> {{ __('dashboard.close') }}
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane"></i> {{ __('dashboard.send') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    Livewire.on('luanch-reply-contact-modal', () => {
        $('#replyContactModal').modal('show');
    });
    Livewire.on('close-modal', () => {
        $('#replyContactModal').modal('hide');
    });
</script>
@endscript