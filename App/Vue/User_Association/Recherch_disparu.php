<?php ob_start(); 
    $title='Rechech_disparue';
?>
<div class="row">
          <div class="col-12 mt-4">
            <div class="card">
              <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Billing Information</h6>
              </div>
              <div class="card-body pt-4 p-3">
                <ul class="list-group">
                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="col-2">
                      <img src="../assets/img/team-2.jpg" class="avatar avatar-xxl" alt="" />
                    </div>
                    <div class="d-flex flex-column col-4">
                      <h6 class="mb-3 text-sm">Elhaanani abdelmouanim</h6>
                      <span class="mb-2 text-xs">
                        Date Naissance:
                        <span class="text-dark font-weight-bold ms-sm-2">01/01/2004</span></span>
                      <span class="text-xs">
                        Ville:
                        <span class="text-dark ms-sm-2 font-weight-bold">
                          Azrou
                        </span>
                      </span>
                      <span class="text-xs">
                        Genner:
                        <span class="text-dark ms-sm-2 font-weight-bold">
                          Homme
                        </span>
                      </span>
                    </div>
                    <div class="d-flex flex-column col-4">
                      <h6 class="mb-3 text-sm">Azrou Association</h6>
                      <span class="mb-2 text-xs">
                        Address:
                        <span class="text-dark font-weight-bold ms-sm-2"
                          >Azrou N°14 Reu 5</span
                        ></span
                      >
                      <span class="mb-2 text-xs">
                        Email Address:
                        <span class="text-dark ms-sm-2 font-weight-bold"
                          >Azrou@gmail.com</span
                        >
                      </span>
                      <span class="text-xs">
                        telephone:
                        <span class="text-dark ms-sm-2 font-weight-bold">
                          06 11 11 11 11
                        </span>
                      </span>
                    </div>
                    <div class="ms-auto text-end">
                      <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;">
                        <i class="ni ni-email-83 text-dark me-2" aria-hidden="true" ></i>
                        Missage
                      </a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
<?php $content = ob_get_clean();
    include_once("./App/Vue/Mastre.php");
?>