<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CASHMATE | Terms and Conditions</title> 
	<link rel="icon" href="Images/CASHMATE.png" type="image/x-icon" width="50px" height="50px">
	<link type= "text/css" rel="stylesheet" href="CashMate.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500&display=swap">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"> </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script> 
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: 'Lexend', sans-serif;
            text-align: justify;
        }

        .terms-content {
            background-color: #fff;
            padding: 5%;
            font-size: medium;
        }

    </style>
</head>

    <nav class="navbar navbar-expand-lg "id="NavBar">
		<div class="container-fluid" id="cf">
			<div class="row" id="head">
				<div class="col-md-3">
					<div class="navbar-preheader">
						<h1 class="text-fluid"><img class="img-fluid" src="Images/CASHMATE.png"  alt="CashMate logo"><b> CASHMATE</b> </h1>
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#drop-img">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					  </button> 
					</div>
				</div>
				<div class="col-md-9 collapse navbar-collapse navbar-right" id="drop-img">
					<ul class="nav navbar-nav "  >
						<li ><a href="Dashboard.php" class="link">Dashboard</a></li>
						<li><a href="Income-page.php" class="link">Income</a></li>
						<li><a href="Spendings.php" class="link">Spendings</a></li>
						<li ><a href="Planner.php" class="link">Planner</a></li> 
						<li ><a href="get-help.php" class="link"><img src="Images/question.png"></a></li> 
						<li ><a href="account-settings.php" class="link"><img src="Images/settings.png"></a></li> 
						<li ><a class="dropdown" data-toggle="dropdown"><img src="Images/male-user.png"></a>  
						  <ul class="dropdown-menu" style="background-color:rgb(140,195,126);">
                            <li>
                                <?php
                                    $profile_photo_path = $user_data['user_profile'];
                                    if (!empty($profile_photo_path)) {
                                        echo '<img src="' . $profile_photo_path . '" style="width:50px;height:50px;margin-right:10px;">';
                                    } else {
                                        echo '<img src="Images/profile photo icon.png" style="width:50px;height:50px;margin-right:10px;">';
                                    }
                                ?>
                            </li>    
							<p style="margin-left:60;margin-right:60;"><?php echo $user_data['user_name'] ?></p>
							<p ><?php echo $user_data['email'] ?></p>
							<p style="margin-left:60;margin-right:60;" ><a href="logout.php" onclick="signOut()">Sign-out</a></p>
						  </ul>
						</li> 
					 </ul> 
				</div>
            </div>
		</div>
	</nav>
    <section class="terms-container">
        <div class="terms-header">
            <div class="terms-content">
                <div class="terms-update">
                    <h2>Terms and Conditions of Use</h2>
                    <p>Last Updated: November 29, 2023</p>
                </div>
    
                <div>
                    <h2><b>CashMate</b></h2>
                    <p>("<b>CashMate</b>," “we,” “us,” or “our”), is the operator of the <b>CashMate</b>.com (together with all content and the underlying source HTML files that implement the hypertext features, collectively the "Site" or "Sites") These terms of use (these “Terms and Conditions of Use”) govern any use of the Sites.</p>
                    <div>
                        <div>
                            <h3>1.	ACCEPTANCE OF CONTRACT TERMS</h3>
                            <p>The following are terms of a legal agreement between you <b>CashMate</b>. By downloading or using an App or by accessing, browsing and/or using the Sites, you acknowledge that you have read, understood, and agree to be bound by these terms and to comply with all applicable laws and regulations. Note that Section 7 of these Terms contains a mandatory arbitration provision that requires the use of arbitration on an individual basis and limits the remedies available to you in the event of certain disputes. If you do not agree to these Terms and Conditions of Use, do not use the Sites.</p>
                            <p>The material provided on the Sites is protected by law, including, but not limited to Philippines Copyright and Trademark laws, and international treaties. The Sites are controlled and operated <b>CashMate</b> from its offices within the Philippines. <b>CashMate</b> makes no representation that materials in the Sites are appropriate or available for use in other locations, and access to them from territories where their contents are illegal is prohibited. Those who choose and access the Sites from other locations do so on their own initiative and are responsible for compliance with applicable local laws. See below for further copyright and trademark information.</p>
                            <p>Any software available from the Sites is subject to the export controls of the Philippines and may not be downloaded or otherwise exported or re-exported into any country to which the Philippines has embargoed goods; or to anyone on the P.H. Treasury Department's list of Specially Designated Nationals, or to any person or entity subject to such restrictions by the P.H government.</p>
                        </div>
                        <div>
                            <h3>2.	OWNERSHIP, LICENSE & RESTRICTIONS ON USE</h3>
                            <p>2.1 All right, title and interest (including all copyrights, trademarks and other intellectual property rights) in the Apps and the Sites belong to <b>CashMate</b> or the original creator of the material. Further, all names, images, pictures, logos and icons on the Sites are proprietary marks of <b>CashMate</b> or by the original creator of the material. The compilation of all content, including the look and feel of the Sites, is the exclusive property of <b>CashMate</b> and is protected by P.H. copyright law. Except as may be expressly provided herein, nothing contained in these Terms and Conditions of Use or elsewhere shall be construed as conferring any license or right, by implication, estoppels or otherwise, under copyright, trademark or other intellectual property rights.</p>
                            <p>2.2 You are hereby granted a personal, non-exclusive, non-transferable, limited license to: (i) use the Sites on your device for your personal non-commercial use only; and (ii) view the Sites, and to print insignificant portions of materials retrieved from the Sites provided (a) it is used only for informational, non-commercial purposes, and (b) you do not remove or obscure the copyright notice or other notices. You are not allowed to modify, copy, distribute, transmit, display, perform, reproduce, publish, license, create derivative works from, transfer or sell any information, products or services obtained directly from the Sites. Further, you may not reproduce any part of the Sites.</p>
                            <p>2.3 You also may not, without the permission of <b>CashMate</b>. "mirror" any material contained on the Sites on any other server. Any unauthorized use of any material contained on the Sites may violate copyright laws, trademark laws, the laws of privacy and publicity, and communications regulations and statutes.</p>
                            <p>2.4 All submissions, suggestions, ideas, artwork, or other information (the "Submission") communicated to <b>CashMate</b> through the Sites become the property of <b>CashMate</b>. <b>CashMate</b> is not required to treat any Submissions as confidential, and will not incur any liability as a result of any similarities that may appear in future <b>CashMate</b> endeavors.</P>
                            <br><b>CashMate</b> will have exclusive ownership of all present and future existing rights, including all commercial rights, to the Submission of every kind and nature in perpetuity throughout the universe.</br>
                            <br>You acknowledge that you are responsible for whatever material you submit, and that you, not <b>CashMate</b>, have full responsibility for the Submission, including its legality, reliability, appropriateness, novelty, and copyright. <b>CashMate</b> reserves the right (but is not obligated) to remove or edit such content, but does not regularly review posted content. <b>CashMate</b> has the right but not the obligation to monitor and edit or remove any activity or content. <b>CashMate</b> takes no responsibility and assumes no liability for any content posted by you or any third party.</br>
                            <p>2.5 The trademarks, service marks, and logos (the "Trademarks") used and displayed on the Sites are registered and unregistered Trademarks of <b>CashMate</b> and others. Nothing on the Sites or any App should be construed as granting, by implication, estoppel, or otherwise, any license or right to use any Trademark displayed on the Sites, without the written permission of the Trademark owner.</p>
                            <p><b>CashMate</b> aggressively enforces its intellectual property rights to the fullest extent of the law. The name of <b>CashMate</b>., <b>CashMate</b> logo, and any other <b>CashMate</b> service names, logos or slogans that may appear on the Sites may not be used in any way, including in advertising or publicity pertaining to distribution of materials on the Sites or any App, without our prior, written permission. <b>CashMate</b> prohibits use of the <b>CashMate</b> logo as a "hot" link to any site, including <b>CashMate</b> sites, unless establishment of such a link is approved in advance by <b>CashMate</b> in writing.</p>
                        </div>
                        <div>
                            <h3>3.	LINKS TO THIRD PARTY SITES</h3>
                            <p>The Sites may contain links to and from third party web sites for your convenience. <b>CashMate</b> has no control over the content or privacy policies of third party sites that you may link to from the Sites or their advertisers. If you visit a linked site, be aware that the third party operating any such site may have access to any information you submit via that site. <b>CashMate</b> is not responsible for any third party's failure to establish or abide by its privacy policy. We suggest always checking the privacy policy in each site that you visit prior to submitting any personal information. Links to third party sites do not imply endorsement of the sites by <b>CashMate</b>.</p>
                        </div>
                        <div>
                            <h3>4.	EFFECTIVE DATE, MODIFICATION; CHANGES TO SITE</h3>
                            <p>These terms are effective and were last updated on the date at the beginning of these Terms and Conditions of Use. At any time, <b>CashMate</b> may revise the terms of the Site. Revisions are effective and binding when posted on the Site and any App. If we make changes, we will post the amended Terms and Conditions of Use to our Sites, and update the “Last Updated” date above. We may also notify you by sending an email notification to the address associated with your account or providing notice through our Sites. Any continued use of the Site and Apps following any revision means you agree to the revisions. <b>CashMate</b> expressly reserves the right to terminate or discontinue the Sites at any time and for any reason, with or without notice to you.</p>
                        </div>
                        <div>
                            <h3>5.	DISCLAIMERS; LIMITATION OF LIABILITY</h3>
                            <p>5.1 CashMate DISCLAIMS ANY AND ALL RESPONSIBILITY FOR ANY LOSS, INJURY, CLAIM, LIABILITY, OR DAMAGE OF ANY KIND RESULTING FROM, ARISING OUT OF, OR IN ANY WAY RELATED TO (A) ANY ERRORS IN OR OMISSIONS ON OR FROM EITHER SITE OR THE APPS, INCLUDING BUT NOT LIMITED TO TECHNICAL INACCURACIES AND TYPOGRAPHICAL ERRORS, (B) ANY THIRD PARTY WEBSITES OR CONTENT THEREIN DIRECTLY OR INDIRECTLY ACCESSED THROUGH LINKS IN EITHER SITE OR THE APPS, INCLUDING BUT NOT LIMITED TO ANY ERRORS IN OR OMISSIONS CONTAINED THEREIN, (C) THE UNAVAILABILITY OF EITHER SITE OR THE APPS OR ANY PORTION THEREOF, (D) YOUR USE OF EITHER SITE OR THE APPS, OR (E) YOUR USE OF ANY EQUIPMENT OR SOFTWARE IN CONNECTION WITH EITHER SITE OR THE APPS.</p>
                            <P>5.2 ANY DEALINGS WITH ANY THIRD PARTIES (INCLUDING ADVERTISERS AND/OR SPONSORS) APPEARING ON EITHER SITE OR THE APPS, PARTICIPATION IN ANY PROMOTIONS OR OFFERINGS (INCLUDING DELIVERY OF AND PAYMENT FOR GOODS AND SERVICES) AND ANY OTHER TERMS, CONDITIONS, WARRANTIES OR REPRESENTATIONS ASSOCIATED WITH SUCH ACTIVITIES ARE SOLELY BETWEEN YOU AND THE ADVERTISER OR OTHER THIRD PARTY. WE ARE NOT RESPONSIBLE FOR EXAMINING OR EVALUATING, AND WE DO NOT WARRANT THE OFFERINGS OF, ANY OF THESE BUSINESSES OR INDIVIDUALS OR THE CONTENT OF THEIR WEBSITES. <b>CashMate</b> DOES NOT ASSUME ANY RESPONSIBILITY OR LIABILITY FOR THE ACTIONS, PRODUCT, AND CONTENT OF ALL THESE AND ANY OTHER THIRD PARTIES. YOU SHOULD CAREFULLY REVIEW THEIR PRIVACY STATEMENTS AND OTHER CONDITIONS OF USE. <b>CashMate</b> IS NOT RESPONSIBLE OR LIABLE TO ANY PARTY WHO PARTICIPATES IN ANY SUCH DEALINGS, PROMOTIONS OR OFFERINGS.</P>
                            <p>5.3 CashMate MAKES NO WARRANTY OR REPRESENTATION, BUT EXPRESSLY DISCLAIMS ANY AND ALL WARRANTIES INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF DESIGN, MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, OR TITLE, ANY WARRANTIES ARISING FROM A COURSE OF DEALING, USAGE, OR TRADE PRACTICE, OR ANY WARRANTIES OF NON-INFRINGEMENT OF ANY THIRD PARTY'S PATENT(S), TRADE SECRET(S), COPYRIGHT(S) OR OTHER INTELLECTUAL PROPERTY RIGHTS. CashMate WILL NOT BE LIABLE FOR ANY DAMAGES (INCLUDING DIRECT, INDIRECT, INCIDENTAL, CONSEQUENTIAL, SPECIAL OR PUNITIVE). <b>CashMate</b> DOES NOT WARRANT THAT THE OPERATION OF THE SITE OR APPS WILL BE UNINTERRUPTED OR ERROR-FREE. NO ORAL OR WRITTEN INFORMATION GIVEN BY <b>CashMate</b> OR AN AUTHORIZED REPRESENTATIVE OF CashMate SHALL CREATE ANY WARRANTY.</p>
                            <p>5.4 If you are dissatisfied with any portion of the Sites or the Apps, or with any of these Terms and Conditions of Use, your sole and exclusive remedy is to discontinue using the Sites.</p>
                        </div>
                        <div>
                            <h3>6.	UNLAWFUL AND PROHIBITED USE</h3>
                            <P>As a specific condition of your use of the Sites, you explicitly agree not to use the Sites for any purpose that is unlawful or prohibited by these Terms and Conditions of Use. You agree not to use the Sites in any way that could damage, disable, overburden, or impair either Site or the Apps, or interfere with anyone else's use of either Site or the Apps. You will not attempt to gain unauthorized access to CashMate computer systems or networks connected to CashMate, through hacking, password mining or any other means. You will not attempt to reverse engineer any portion of the Sites or attempt to infringe the intellectual property rights of others in any way. You will not obtain or attempt to obtain any materials or information through any means not intentionally made available through the Sites.</P>
                        </div>
                        <div>
                            <h3>7.	BINDING ARBITRATION; GOVERNING LAW AND JURISDICTION</h3>
                            <p>PLEASE READ THE FOLLOWING SECTION CAREFULLY BECAUSE IT REQUIRES YOU TO ARBITRATE CERTAIN DISPUTES AND CLAIMS WITH <b>CashMate</b> AND LIMITS THE MANNER IN WHICH YOU CAN SEEK RELIEF FROM US</p>
                            <p>These Terms and Conditions of Use are governed by the laws of Philippines. without regard to P.H conflict of laws provisions. By using either Site or the Apps you irrevocably consent to the exclusive jurisdiction and venue of the state and federal courts in Philippines for all disputes arising out of or relating to the use of the Sites and/or Apps. CashMate makes no representation that the contents of the Sites are appropriate or available for use in other locations, and those who choose to access the Sites from other locations are solely responsible for compliance with their local laws. Any legal actions against CashMate must be commenced within two year(s) after the claim arose. EXCEPT FOR CONTROVERSIES OR CLAIMS IN WHICH EITHER PARTY SEEKS TO BRING AN INDIVIDUAL ACTION IN SMALL CLAIMS COURT, YOU AND CashMate AGREE (A) TO WAIVE YOUR AND CashMate RESPECTIVE RIGHTS TO HAVE ANY AND ALL CONTROVERSIES AND CLAIMS ARISING FROM OR RELATED TO THE SITES, APPS, OR THESE TERMS RESOLVED IN A COURT, AND (B) TO WAIVE YOUR AND CashMate RESPECTIVE RIGHTS TO A JURY TRIAL. INSTEAD, ANY CONTROVERSY OR CLAIM ARISING OUT OF OR RELATING TO THE SITES, APPS, OR THESE TERMS WILL BE SETTLED BY BINDING ARBITRATION BEFORE JAMS, INC. AND IN ACCORDANCE WITH THE JAMS COMPREHENSIVE ARBITRATION RULES AND PROCEDURES. ANY SUCH CONTROVERSY OR CLAIM SHALL BE ARBITRATED ON AN INDIVIDUAL BASIS, AND SHALL NOT BE CONSOLIDATED IN ANY ARBITRATION WITH ANY CLAIM OR CONTROVERSY OF ANY OTHER PARTY. By agreeing to be bound by these Terms and Conditions of Use, you either (a) acknowledge and agree that you have read and understand the rules of JAMS, or (b) waive your opportunity to read the rules of JAMS and any claim that the rules of JAMS are unfair or should not apply for any reason. Each party shall be responsible for its costs incurred in such arbitration, but if you cannot afford to pay for the arbitration you agree to provide us the option of paying the arbitrator before seeking to initiate any other form of dispute resolution, including litigation. The arbitration will be conducted in Philippines, and judgment on the arbitration award may be entered into any court having jurisdiction thereof. The award of the arbitrator shall be final and binding upon the parties without appeal or review. You have the right to opt out of binding arbitration within thirty (30) days of the date you first accepted the terms of this Section 7 by writing to: Atty Nathaniel Pulvinar. In order to be effective, the opt-out notice must include your full name and clearly indicate your intent to opt out of binding arbitration. If you do not notify CashMate in accordance with this section, you agree to be bound by the arbitration and class-action waiver provisions of these Terms and Conditions of Use, including such provisions in any Terms and Conditions of Use revised after the date of your first acceptance. By opting out of binding arbitration, you are agreeing to resolve all controversies and claims on an individual basis in a court located in Philippines. Notwithstanding the foregoing, CashMate may immediately seek any interim or preliminary injunctive relief from any court of competent jurisdiction, as necessary to protect its rights or property (including intellectual property rights).</p>
                        </div>
                        <div>
                            <h3>8.	INDEMNITY</h3>
                            <p>You specifically agree to indemnify and hold harmless <b>CashMate</b>, its parent, affiliates, stockholders, officers and employees, from any claim, demand or damage, including reasonable attorneys' fees, asserted by any third party due to or arising out of your use of or conduct on the Sites and/or Apps.</p>
                        </div>
                        <div>
                            <h3>9. PRODUCT & SERVICE AVAILABILITY</h3>
                            <p>The Sites contain references and information about CashMate products and services that may be limited by individual store participation in the Philippines only.</p>
                        </div>
                        <div>
                            <h3>10. PRIVACY AND PUBLICITY</h3>
                            <p><b>CashMate's</b> privacy policy is located at www.CashMate.com and is hereby incorporated into these Terms and Conditions of Use by reference. We reserve the right to modify our privacy policy from time to time. You may be asked whether or not you wish to receive marketing and other non-critical communications relating to CashMate services from time to time. You may opt-out of receiving such communications at that time as provided in the privacy policy.</p>
                        </div>
                        <div>
                            <h3>11. ENTIRE AGREEMENT; SERVERABILITY</h3>
                            <p>These Terms and Conditions of Use incorporate by reference any notices contained on the Sites and constitute the entire agreement with respect to your access to and use of the Sites. If any provision of these Terms and Conditions of Use is unlawful, void or unenforceable, then that provision shall be deemed severable from the remaining provisions and shall not affect their validity and enforceability.</p>
                        </div>
                        <div>
                            <h3>12. DIGITAL MILENNIUM COPYRIGHT ACT ("DMCA) NOTICE</h3>
                            <p>We are committed to complying with copyright and related laws, and we require all users of the Sites to comply with these laws. Accordingly, you may not store any material or content on, or disseminate any material or content over, the Sites in any manner that constitutes an infringement of third party intellectual property rights, including rights granted by copyright law. </p>
                            <div class="copyright-issue">
                                <p>If you believe that your work has been copied and posted on either Site in a way that constitutes copyright infringement, please provide our designated agent with the following information:</p>
                                <ul>
                                    <li>an electronic or physical signature of the person authorized to act on behalf of the owner of the copyright or other intellectual property interest;</li>
                                    <li>a description of the copyrighted work or other intellectual property that you claim has been infringed;</li>
                                    <li>a description of where the material that you claim is infringing is located on the Sites;</li>
                                    <li>your address, telephone number, and email address;</li>
                                    <li>a statement by you that you have a good faith belief that the disputed use is not authorized by the copyright or intellectual property owner, its agent, or the law; and</li>
                                    <li>a statement by you, made under penalty of perjury, that the information contained in your report is accurate and that you are the copyright or intellectual property owner or authorized to act on the copyright or intellectual property owner's behalf.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer >
        <div class="container-fluid">
            <div class="row" id="footer">
                <div class="col-md-8">
                    <div class="footer-clmn1">
                    <h1>CashMate</h1>
                    <p>Navigate Your Finances with Confidence</p>
                </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-clmn2">
                    <p> STAY CONNECTED WITH</p>
				    <a href="group-profile.html"><img src="Images/BlancCapybara.png" height="50"alt="Description of the image"></a>
                </div>
            </div>
        </div>
        <div class="row" id="footer-b">
            <div class="col-md-6">
                <div class="footer-2clmn1">
                    <p> Copyright 2023 © CashMate. All rights reserved.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="footer-2clmn2">
                    <p><a href="terms-conditions.php">Terms of Use </a>|<a href="privacy-policy.php"> Privacy Policy </a>|<a href="sitemap.php"> Site Map </a>|</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>