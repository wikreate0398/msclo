

<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="chatModalLabel">Тестовое модальное окно</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
             </button>
          </div>
          <div class="modal-body">
            <!-- Subscribe Form -->
            <form class="js-form-message ajax__submit" action="{{ route('statistics.callback', compact('lang')) }}">
               {{ csrf_field() }}
               <label class="sr-only" for="subscribeSrEmail">Текст</label>
               <div class="input-group input-group-pill">
                     <input type="text" class="form-control border-0 height-40" name="text" id="subscribeSrEmail" placeholder="Текст" required>
                     <div class="input-group-append">
                        <button type="submit" class="btn btn-dark btn-sm-wide height-40 py-2 submit-btn" id="subscribeButton">Отправить</button>
                     </div>
               </div>
            </form>
            <!-- End Subscribe Form -->
             <p class="modal-text mt-5"> Тестовое модальное окно. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum numquam quidem accusamus voluptatibus reiciendis corporis molestias ex sunt voluptate. Molestias modi necessitatibus voluptatem molestiae totam facere earum reprehenderit quibusdam cumque? </p>
          </div>
          <div class="modal-footer">
             <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Отмена</button>
          </div>
       </div>
    </div>
 </div>