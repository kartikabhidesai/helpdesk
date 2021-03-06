<div class="wrapper wrapper-content white-bg m-t">
    <div class=" animated fadeInRightBig">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="col-sm-5 displaylable">
                            <a href="<?= admin_url('estimate/view/') . $this->utility->encode($expenseData[0]->id); ?>"  style="margin:5px 5px 5px -6px"  data-original-title="Pay Invoice" class="btn btn-primary btn-sm "><strong><i class="fa fa-google-wallet"></i>  View Estimate</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="encodeUrl" value="<?= $this->utility->encode($expenseData[0]->id); ?>" class="encodeUrl">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" class="form-horizontal" action="<?= admin_url('estimate/expense/') . $this->utility->encode($expenseData[0]->id); ?>" id='expenseForm'>
                    <div class="wrapper wrapper-content animated fadeInRight">
                        <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <img src="<?= IMAGES . 'logo.png'; ?>" style="width: auto;height: 120px;margin-top: -45px !important;">
                                    </address>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Estimate No. <?= $expenseData[0]->ref_no; ?></h4>
                                    <h4>Estimate Date: <?= date('M d, Y', strtotime($expenseData[0]->dt_created)); ?>    </h4>
                                    <h4>Due Date: <?= date('M d, Y', strtotime($expenseData[0]->due_date)); ?> </h4>
                                </div>
                            </div>
                                <div class="row well m-t">
                                <div class="col-md-6">
                                    <h4>Received From:</h4>
                                    <h4>Expert Tech | Justin Govan</h4>
                                    <h4>142 Brier Park Rd Brantford, ON N3R 5T7 Canada</h4>
                                    <h4>Phone: 519-719-7586</h4>
                                </div>

                                <div class="col-sm-6 text-right">
                                    <h4>Bill To:</h4>
                                    <h4><?= $expenseData[0]->companyName; ?></h4>
                                    <h4><?= $expenseData[0]->companyAddress .', ' .$expenseData[0]->companyCity .', ' .$expenseData[0]->countryName ?></h4>
                                    <h4>Phone : <?= $expenseData[0]->companyPhone  ?></h4>
                                </div>
                            </div>
                            <div class="table-responsive m-t">
                                <table class="table invoice-table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 16% !important; ">Item Name </th>
                                            <th style='text-align: left;'>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $subTotal = 0;
                                        for ($i = 0; $i < count($expensepaymentData); $i++) {
                                            if (!empty($expensepaymentData[$i]->price)) {
                                                $itemTotal = $expensepaymentData[$i]->quentity * $expensepaymentData[$i]->price;
                                                $subTotal += $itemTotal;
                                                ?>
                                                <tr>
                                                    <td class="form-group"><?= date('M d', strtotime($expenseData[0]->dt_created)); ?> | <?= $expensepaymentData[$i]->expense_name ?> </td>
                                                    <td class="form-group"style='text-align: left;'> <?= $expensepaymentData[$i]->expense_desc ?></td>
                                                    <td class="form-group"> <?= $expensepaymentData[$i]->quentity ?></td>
                                                    <td class="form-group"> <?= $expenseData[0]->currency . $expensepaymentData[$i]->price ?></td>
                                                    <td class="form-group">
                                                        <?= $expenseData[0]->currency . $itemTotal; ?> 
                                                        <a data-toggle="modal" data-target="#myModal_autocomplete" data-href="<?= admin_url() . 'estimate/expenseDelete' ?>" data-id="<?php echo $expensepaymentData[$i]->paymentId; ?>" class="deletePayment">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td><input type="text" placeholder="Item Name" name="item_name" class="form-control"></td>
                                            <td><input type="text" placeholder="Item Description" name="item_desc" class="form-control"></td>
                                            <td><input type="text" placeholder="1" name="quentity" class="form-control"></td>
                                            <td><input type="text" placeholder="56.12" name="price" class="form-control"></td>
                                    <input type="hidden" name="id" id="invoiceId" value="<?= $expenseData[0]->id; ?>" class="form-control">
                                    <td>
                                        <div class="text-right">
                                            <button  class="btn btn-success "><i class="fa fa-check"></i> Save</button>
                                        </div>
                                    </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->
                            <?php
                            if (count($expensepaymentData) > 0) {
                                ?>
                                <table class="table invoice-total">
                                    <tbody>
                                        <tr>
                                            <td><strong>TOTAL :</strong></td>
                                            <td><?= $expenseData[0]->currency . number_format($subTotal, 2) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php } ?>
                            <div class="well m-t"><?= $expenseData[0]->note; ?>
                            </div>
                        </div>
                        <div class="modal inmodal" id="myModal_autocomplete" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <i class="fa fa-close modal-icon"></i>
                                        <h4 class="modal-title">Delete</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Are you sure?</h4>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        <button  id='btndelete' data-url="" data-id="" type="button" class="btn btn-primary">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal inmodal" id="myModal_Invoice_email" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Email Estimate</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Subject: </label>
                                            <div class="col-sm-9">
                                                <input type="text" value="ESTIMATE <?= $expenseData[0]->ref_no; ?>"  name="subject" readonly="" class="form-control email_invoice">
                                                <input type="hidden" value="<?= $expenseData[0]->id ?>"  name="invoiceId" class="form-control invoiceId">
                                            </div>
                                        </div><br/><br/><br/>
                                        <div style="height: 7px; background-color: #535353;"></div>
                                        <div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">ESTIMATE {REF}</div>
                                            <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><span class="style1"><span style="font-weight:bold;">Hello {CLIENT}</span></span><br><br>Here is the estimate of {CURRENCY} {AMOUNT}.<br><br>You can view the estimate online at:<br><span style="font-size:14px;"><a href="{ESTIMATE_LINK}">{ESTIMATE_LINK}</a></span><br><br>Regards,<br><br>The {SITE_NAME} Team</div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary send_invoice "  type="submit">Send Estimate</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal inmodal" id="myModal_reminder" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Estimate Reminder</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Subject: </label>
                                            <div class="col-sm-9">
                                                <input type="text" value="Estimate <?= $expenseData[0]->ref_no; ?> Reminder" readonly="" name="subject" class="form-control reminser_invoice">
                                                <input type="hidden" value="<?= $expenseData[0]->id ?>"  name="invoiceId" class="form-control reminderInvoiceId">
                                            </div>
                                        </div><br/><br/><br/>
                                        <div style="height: 7px; background-color: #535353;"></div>
                                        <div style="background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;"><div style="text-align:center; font-size:24px; font-weight:bold; color:#535353;">Estimate Reminder</div>
                                            <div style="border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;"><p>Hello {CLIENT}</p>
                                                <br><p>This is a friendly reminder to pay your estimate of {CURRENCY} {AMOUNT}<br>You can view the estimate online at:<br><big><b><a href="{INVOICE_LINK}">View Estimate</a></b></big><br><br>Regards,<br>The {SITE_NAME} Team</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary send_reminder" type="submit">Send Reminder</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
