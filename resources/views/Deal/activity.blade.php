<div class="modal fade" id="createModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">اضافة مهمة جديدة</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{route('activity.store')}}">

                    @csrf

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">المهمة</label>
                        <input class="form-control" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">النوع</label>
                        <select name="type" class="form-control" required>
                            <option value="" disabled selected>حدد نوع المهمة</option>
                            <option value="lunch">غذاء</option>
                            <option value="call">مكالمة</option>
                            <option value="meet">اجتماع</option>
                            <option value="note">تدوين ملاحظة</option>
                        </select>
                    </div>

                        <input type="hidden" name="deal_id" value="{{$deal->id}}">




                    <div class="form-group">
                        <label for="message-text" class="col-form-label" >من تاريخ</label>

                        <div class="input-group-text">

                            <input class="form-control" required  type="datetime-local" name="start">
                        </div>
                    </div>
                    <div class="form-group">

                        <label for="message-text" class="col-form-label">الى تاريخ</label>

                        <div class="input-group-text">
                            <input class="form-control " required  type="datetime-local" name="end">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="message-text" class="col-form-label">اسند مستخدمين لهذه المهمة</label>
                        <select class="form-control " multiple name="assigned_to[]">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ملاحظات</label>
                        <textarea class="form-control" name="comment"> </textarea>
                    </div>
                        <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>


                </form>
            </div>

        </div>
    </div>
</div>
