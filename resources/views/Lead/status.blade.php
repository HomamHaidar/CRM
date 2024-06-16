<div class="modal fade" id="archiveModal{{$client->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="status-header"></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{ route('lead.archive',$client->id) }}">
                    @method('PUT')
                    @csrf
                    <h5 id="status-header2">    </h5>
                    <h5 >{{$client->name}} ؟    </h5>

                    <input type="hidden" name="status" id="status-input" value="">


                    <div class="form-group">
                        <label for="message-text" class="col-form-label">دون افكارك عن الصفقة:</label>
                        <textarea class="form-control" id="message-text" name="why_status"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
