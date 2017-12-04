
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <!-- first Panel start Here -->

        <?php $heading = array('0' => 'One', '1' => 'Two', '2' => 'Three', '3' => 'Four', '4' => 'Five', '5' => 'Six', '6' => 'Seven', '7' => 'Eight', '8' => 'Nine', '9' => 'Ten', '10' => 'Eleven', '11' => 'Twelve', '12' => 'Thirteen', '13' => 'Fourteen', '14' => 'Fifteen', '15' => 'Sixteen', '16' => 'Seventeen', '17' => 'Eighteen', '18' => 'Nineteen', '19' => 'Twenty', '20' => 'TwentyOne' ) ?>

        @foreach($categoriesButtonsName as $key => $categoryButtonsName)
            <div class="panel panel-default" style="border-radius: 0; border: 0;">
                <div class="panel-heading" role="tab" id="heading{{$heading[$key]}}" style="background-color: #2ab27b; border-radius: 0; color: white;">
                    <h4 class="panel-title" style="background-color: #2ab27b;">
                        <a  style="color: white; background-color: #2ab27b;" class="" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$heading[$key]}}" aria-expanded="true" aria-controls="collapse{{$heading[$key]}}" class="collapsed">
                           {{ $categoryButtonsName->name }}  <span class="pull-right" aria-hidden="true"><i class="fa fa-plus-square" aria-hidden="true"></i></span>
                        </a>
                    </h4>
                </div>

                <div id="collapse{{$heading[$key]}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$heading[$key]}}" aria-expanded="true" >
                    <div class="panel-body" style="background-color: #f5f5f5">
                        <div class="list-group" >
                            @foreach($subCategoriesButtonsName as $subCategoryButtonsName)
                                @if ($subCategoryButtonsName->category_id == $categoryButtonsName->id)
                                    <div class="checkbox">
                                        <label>
                                            <a href="/store/search?category={{ $subCategoryButtonsName->identifier }}">{{ $subCategoryButtonsName->name }}</a>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <!-- List Group End Here -->
                    </div>
                </div>
            </div>         <!-- first Panel End Here -->
        @endforeach
    </div><!-- /.sidebar column end here -->
        