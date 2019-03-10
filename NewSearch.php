<?php
    session_start();
    
?>
 
<?php
    require 'header.php';
?>

    <?php
        require 'navbar.php';
    ?>

    <!-- END NAVBAR -->

    <div class="searchFormContainer">
        <form action="includes/LoadSearchResult.inc.php" method="POST" id="searchForm">
            <div class="form-group searchFormDiv">
                <label for="cityListInput"><h5>Địa điểm</h5></label>
                <input class="form-control" id ="cityListInput" type="text" name="cityName" placeholder="city" required>
                <input class="form-control" id ="addressInput" type="text" name="address" placeholder="Đường Xá Quận Huyện">
            </div>
            <div class="form-group searchFormDiv">
                <label for="minPrice"><h5>Giá</h5></label>
                <input class="form-control" id ="minPrice" type="number" name="minPrice" placeholder="Minimum (Billion)" min="0">
        
                <input class="form-control" id ="maxPrice" type="number" name="maxPrice" placeholder="Maximum (Billion)" min="1">
        
            </div>
            <div class="form-group searchFormDiv">
                <label for="Bedroom"><h5>Phòng ngủ</h5></label>
                <select id="Bedroom" class="form-control" name="numBedroom" placeholder="Phòng ngủ">
                    <option value="" disabled selected>Phòng ngủ</option>
                    <option value="1">1+</option>
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                    <option value="4">4+</option>
                    <option value="5">5+</option>
                </select>
            </div>

            <div class="searchFormDiv">
                <h5>Gần</h5>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="schoolCB" class="custom-control-input" id="checkBoxSchool">
                    <label class="custom-control-label" for="checkBoxSchool">Trường học</label>    
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="hospitalCB" class="custom-control-input" id="checkBoxHospital">
                    <label class="custom-control-label" for="checkBoxHospital">Bệnh viện</label>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="parkCB" class="custom-control-input" id="checkBoxPark">
                    <label class="custom-control-label" for="checkBoxPark">Công viên</label>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="kinCB" class="custom-control-input" id="checkBoxKindergarten">
                    <label class="custom-control-label" for="checkBoxKindergarten">Nhà trẻ</label>
                </div>
            </div>
            <div class="searchFormDiv">
                <h5>Tiện ích</h5>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="bikeCB" class="custom-control-input" id="checkBoxParkingMoto">
                    <label class="custom-control-label" for="checkBoxParkingMoto">Để xe máy</label>    
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="carCB" class="custom-control-input" id="checkBoxParkingCar">
                    <label class="custom-control-label" for="checkBoxParkingCar">Để ô tô</label>    
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="gymCB" class="custom-control-input" id="checkBoxGym">
                    <label class="custom-control-label" for="checkBoxGym">Gym</label>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="securityCB" class="custom-control-input" id="checkBoxSecurity">
                    <label class="custom-control-label" for="checkBoxSecurity">An ninh</label>
                </div>
                  
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="poolCB" class="custom-control-input" id="checkBoxPool">
                    <label class="custom-control-label" for="checkBoxPool">Bể bơi</label>
                </div>
            </div>
            <div class="searchFormDiv">
                <h5>Pháp lý</h5>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="redNoteCB" class="custom-control-input" id="checkBoxRednote">
                    <label class="custom-control-label" for="checkBoxRednote">Sổ đỏ</label>    
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="pinkNoteCB" class="custom-control-input" id="checkPinknote">
                    <label class="custom-control-label" for="checkPinknote">Sổ hồng</label>
                </div>

                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="constructionPaperCB" class="custom-control-input" id="checkBoxConstructionNote">
                    <label class="custom-control-label" for="checkBoxConstructionNote">Giấy phép xây dựng</label>
                </div>
            </div>    
            <div class="searchFormDiv">
                <div class="form-group searchFormDiv">
                    <button type="submit" name="searchSubmit" class="btn btn-primary btn-lg">Tìm</button>
                </div>
            </div>


            
        </form>
    </div>

    <div class="container" id="resultContainer">
        <nav aria-label=...>
            <ul class= "pagination">
                <li id="previous-page"><a href="javascript:void(0)" aria-label=Previous><span aria-hidden=true>&laquo;</span></a></li>
            </ul>
        </nav>

        <div id="page">

        </div>
    </div>
<?php
    require 'footer.php';
?>





