<?php
session_start();
	include('include/func.php');

	
	// //POST値チェック
	// if(!isset($_POST["grade"]) || !isset($_POST["name"])){
	//   exit;
	// }
echo "string";
	//DB処理
	// 接続
	try{
	    $pdo = new PDO('sqlite:pstc.db');
	    // SQL実行時にもエラーの代わりに例外を投げるように設定
	    // (毎回if文を書く必要がなくなる)
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	    // デフォルトのフェッチモードを連想配列形式に設定 
	    // (毎回PDO::FETCH_ASSOCを指定する必要が無くなる)
	    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

		$stmt = $pdo->prepare("SELECT * FROM member WHERE grade=:grade AND name=:name ");
		$stmt->bindValue(':grade', $_POST["grade"]);
		$stmt->bindValue(':name', $_POST["name"]);
		$res = $stmt->execute();

		$val = $stmt->fetch(); //データが1レコードとわかってる場合こちらを使用


		//該当レコードがあればSESSIONに値を代入
		if( $val["name"] != "" ){
			//echo "notnul";
		  loginSessionSet($val);
		  // header("Location: mypage.php");
		}else{
			//echo "null";
		  //logout処理を経由して全画面へ
		  // header("Location: index_with_error.html");
		}
?>

<!DOCTYPE HTML>
<!--
	Highlights by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Passing Shot Tennis Club</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
			<script src="assets/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/dist/sweetalert.css">
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<section id="header">
				<header class="major">
					<h1>Passing Shot Tennis Club</h1>
					<p>非公式サイト</p>
				</header>
				
			</section>

		<!-- One -->
			<section id="one" class="main special">
				<div class="container">
					<span class="image fit primary"><img src="images/S__25198607.jpg" alt="" /></span>
					<div class="content">




<?php
		echo	"<header class='major'>
				<h2>".$val["name"]."の滞納費</h2>
				</header>";

				$stmt = $pdo->prepare("SELECT * FROM tainou WHERE member_id = ?");
   			 $stmt->execute([$_SESSION['id']]);





// echo "<form action='change_act.php' method='post' name='change' >";


echo "<TABLE  border='1' >";
echo "<TR>";
echo "<TD><font size='5'>イベント</font>";
echo "</TD>";
echo "<TD><font size='5'>滞納費</font>";
echo "</TD>";
echo "</TR>";

$sum=0;
$count=0;
//１ループで１行データが取り出され、データが無くなるとループを抜けます。
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){

    echo "<TR>";

    $stmt2=$pdo->prepare("SELECT * FROM event WHERE id = ?");
    $event_id = $result["event_id"];
    $stmt2->execute([$event_id]);
    $val = $stmt2->fetch();

    
        //列１を出力//////////////
        // echo "<TABLE  border='1' >";
        // echo "<TR>";
        // echo "<TD>".$val["years"]."</TD>";
        // echo "<TD>".$val["event"]."</TD>";
        // echo "</TR>";
        // echo "</TABLE>";
        
        echo "<TD>".$val["years"]."    ".$val["event"]."</TD>";
        // $stmt2=$pdo->prepare("SELECT * FROM event id=?");
        // $stmt2->execute($result["event_id"]);
        // $val = $stmt2->fetch();
        // echo $val["years"];
        // echo "</TD><TD>";
        // echo $val["months"];
        // echo "</TD><TD>";
        // echo $val["event"];

        // echo "<input type='hidden' name='event".$count."' value='".$result["event"]."'";
        //////////////////////////

        //列２を出力//////////////
        // echo "<TD><input type='text' name='tainouhi".$count."' value='" . $result["tainouhi"]."' >";
      	echo "<TD>".$result["tainouhi"];
        echo "</TD>";
        //////////////////////////
      	$sum += $result["tainouhi"];
      	$count++;
    echo "</TR>";
}
echo "<input type='hidden' name='count' value='".$count."'>";
echo "<TR><TD>合計</TD><TD>".$sum."</TD></TR>";
echo "</TABLE>";
echo "</FROM>";







	} catch (Exception $e) {
	    echo $e->getMessage() . PHP_EOL;
	}



?>
<input type="button" class="special" value="トップに戻る" onclick="location.href='index.html'">
<!-- <input class="special" type="button" value="更新"  onclick="return login(this.form)" /> -->





					</div>
					<a href="#two" class="goto-next scrolly">Next</a>
				</div>
			</section>

		<!-- Two -->
			<!-- <section id="two" class="main special">
				<div class="container">
					<span class="image fit primary"><img src="images/IMG_3195.JPG" alt="" /></span>
					<div class="content">
						<header class="major">
							<h2>Stuff I do</h2>
						</header>
						<p>Consequat sed ultricies rutrum. Sed adipiscing eu amet interdum lorem blandit vis ac commodo aliquet vulputate.</p>
						<ul class="icons-grid">
							<li>
								<span class="icon major fa-camera-retro"></span>
								<h3>Magna Etiam</h3>
							</li>
							<li>
								<span class="icon major fa-pencil"></span>
								<h3>Lorem Ipsum</h3>
							</li>
							<li>
								<span class="icon major fa-code"></span>
								<h3>Nulla Tempus</h3>
							</li>
							<li>
								<span class="icon major fa-coffee"></span>
								<h3>Sed Feugiat</h3>
							</li>
						</ul>
					</div>
					<a href="#three" class="goto-next scrolly">Next</a>
				</div>
			</section>
 -->
		<!-- Three -->
			<!-- <section id="three" class="main special">
				<div class="container">
					<span class="image fit primary"><img src="images/IMG_3195.jpg" alt="" /></span>
					<div class="content">
						<header class="major">
							<h2>One more thing</h2>
						</header>
						<p>Aliquam ante ac id. Adipiscing interdum lorem praesent fusce pellentesque arcu feugiat. Consequat sed ultricies rutrum. Sed adipiscing eu amet interdum lorem blandit vis ac commodo aliquet integer vulputate phasellus lorem ipsum dolor lorem magna consequat sed etiam adipiscing interdum.</p>
					</div>
					<a href="#footer" class="goto-next scrolly">Next</a>
				</div>
			</section> -->

		<!-- Four -->
		<!--
			<section id="four" class="main">
				<div class="container">
					<div class="content">
						<header class="major">
							<h2>Elements</h2>
						</header>
						<section>
							<h4>Text</h4>
							<p>This is <b>bold</b> and this is <strong>strong</strong>. This is <i>italic</i> and this is <em>emphasized</em>.
							This is <sup>superscript</sup> text and this is <sub>subscript</sub> text.
							This is <u>underlined</u> and this is code: <code>for (;;) { ... }</code>. Finally, <a href="#">this is a link</a>.</p>
							<hr />
							<header>
								<h4>Heading with a Subtitle</h4>
								<p>Lorem ipsum dolor sit amet nullam id egestas urna aliquam</p>
							</header>
							<p>Nunc lacinia ante nunc ac lobortis. Interdum adipiscing gravida odio porttitor sem non mi integer non faucibus ornare mi ut ante amet placerat aliquet. Volutpat eu sed ante lacinia sapien lorem accumsan varius montes viverra nibh in adipiscing blandit tempus accumsan.</p>
							<header>
								<h5>Heading with a Subtitle</h5>
								<p>Lorem ipsum dolor sit amet nullam id egestas urna aliquam</p>
							</header>
							<p>Nunc lacinia ante nunc ac lobortis. Interdum adipiscing gravida odio porttitor sem non mi integer non faucibus ornare mi ut ante amet placerat aliquet. Volutpat eu sed ante lacinia sapien lorem accumsan varius montes viverra nibh in adipiscing blandit tempus accumsan.</p>
							<hr />
							<h2>Heading Level 2</h2>
							<h3>Heading Level 3</h3>
							<h4>Heading Level 4</h4>
							<h5>Heading Level 5</h5>
							<h6>Heading Level 6</h6>
							<hr />
							<h5>Blockquote</h5>
							<blockquote>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan faucibus. Vestibulum ante ipsum primis in faucibus lorem ipsum dolor sit amet nullam adipiscing eu felis.</blockquote>
							<h5>Preformatted</h5>
							<pre><code>i = 0;

while (!deck.isInOrder()) {
print 'Iteration ' + i;
deck.shuffle();
i++;
}

print 'It took ' + i + ' iterations to sort the deck.';</code></pre>
						</section>

						<section>
							<h4>Lists</h4>
							<div class="row">
								<div class="6u 12u$(medium)">
									<h5>Unordered</h5>
									<ul>
										<li>Dolor pulvinar etiam.</li>
										<li>Sagittis adipiscing.</li>
										<li>Felis enim feugiat.</li>
									</ul>
									<h5>Alternate</h5>
									<ul class="alt">
										<li>Dolor pulvinar etiam.</li>
										<li>Sagittis adipiscing.</li>
										<li>Felis enim feugiat.</li>
									</ul>
								</div>
								<div class="6u$ 12u(medium)">
									<h5>Ordered</h5>
									<ol>
										<li>Dolor pulvinar etiam.</li>
										<li>Etiam vel felis viverra.</li>
										<li>Felis enim feugiat.</li>
										<li>Dolor pulvinar etiam.</li>
										<li>Etiam vel felis lorem.</li>
										<li>Felis enim et feugiat.</li>
									</ol>
									<h5>Icons</h5>
									<ul class="icons">
										<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
									</ul>
								</div>
							</div>
							<h5>Actions</h5>
							<ul class="actions">
								<li><a href="#" class="button special">Default</a></li>
								<li><a href="#" class="button">Default</a></li>
							</ul>
							<ul class="actions small">
								<li><a href="#" class="button special small">Small</a></li>
								<li><a href="#" class="button small">Small</a></li>
							</ul>
							<div class="row">
								<div class="6u 12u$(small)">
									<ul class="actions vertical">
										<li><a href="#" class="button special">Default</a></li>
										<li><a href="#" class="button">Default</a></li>
									</ul>
								</div>
								<div class="6u$ 12u$(small)">
									<ul class="actions vertical small">
										<li><a href="#" class="button special small">Small</a></li>
										<li><a href="#" class="button small">Small</a></li>
									</ul>
								</div>
								<div class="6u 12u$(small)">
									<ul class="actions vertical">
										<li><a href="#" class="button special fit">Default</a></li>
										<li><a href="#" class="button fit">Default</a></li>
									</ul>
								</div>
								<div class="6u$ 12u$(small)">
									<ul class="actions vertical small">
										<li><a href="#" class="button special small fit">Small</a></li>
										<li><a href="#" class="button small fit">Small</a></li>
									</ul>
								</div>
							</div>
						</section>

						<section>
							<h4>Table</h4>
							<h5>Default</h5>
							<div class="table-wrapper">
								<table>
									<thead>
										<tr>
											<th>Name</th>
											<th>Description</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Item One</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item Two</td>
											<td>Vis ac commodo adipiscing arcu aliquet.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item Three</td>
											<td> Morbi faucibus arcu accumsan lorem.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item Four</td>
											<td>Vitae integer tempus condimentum.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item Five</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2"></td>
											<td>100.00</td>
										</tr>
									</tfoot>
								</table>
							</div>

							<h5>Alternate</h5>
							<div class="table-wrapper">
								<table class="alt">
									<thead>
										<tr>
											<th>Name</th>
											<th>Description</th>
											<th>Price</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Item One</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item Two</td>
											<td>Vis ac commodo adipiscing arcu aliquet.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item Three</td>
											<td> Morbi faucibus arcu accumsan lorem.</td>
											<td>29.99</td>
										</tr>
										<tr>
											<td>Item Four</td>
											<td>Vitae integer tempus condimentum.</td>
											<td>19.99</td>
										</tr>
										<tr>
											<td>Item Five</td>
											<td>Ante turpis integer aliquet porttitor.</td>
											<td>29.99</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2"></td>
											<td>100.00</td>
										</tr>
									</tfoot>
								</table>
							</div>
						</section>

						<section>
							<h4>Buttons</h4>
							<ul class="actions">
								<li><a href="#" class="button special">Special</a></li>
								<li><a href="#" class="button">Default</a></li>
							</ul>
							<ul class="actions">
								<li><a href="#" class="button">Default</a></li>
								<li><a href="#" class="button small">Small</a></li>
							</ul>
							<ul class="actions fit">
								<li><a href="#" class="button special fit">Fit</a></li>
								<li><a href="#" class="button fit">Fit</a></li>
							</ul>
							<ul class="actions fit small">
								<li><a href="#" class="button special fit small">Fit + Small</a></li>
								<li><a href="#" class="button fit small">Fit + Small</a></li>
							</ul>
							<ul class="actions">
								<li><a href="#" class="button special icon fa-download">Icon</a></li>
								<li><a href="#" class="button icon fa-download">Icon</a></li>
							</ul>
							<ul class="actions">
								<li><span class="button special disabled">Disabled</span></li>
								<li><span class="button disabled">Disabled</span></li>
							</ul>
						</section>

						<section>
							<h4>Form</h4>
							<form method="post" action="#">
								<div class="row uniform">
									<div class="6u 12u$(xsmall)">
										<input type="text" name="demo-name" id="demo-name" value="" placeholder="Name" />
									</div>
									<div class="6u$ 12u$(xsmall)">
										<input type="email" name="demo-email" id="demo-email" value="" placeholder="Email" />
									</div>
									<div class="12u$">
										<div class="select-wrapper">
											<select name="demo-category" id="demo-category">
												<option value="">- Category -</option>
												<option value="1">Manufacturing</option>
												<option value="1">Shipping</option>
												<option value="1">Administration</option>
												<option value="1">Human Resources</option>
											</select>
										</div>
									</div>
									<div class="4u 12u$(small)">
										<input type="radio" id="demo-priority-low" name="demo-priority" checked>
										<label for="demo-priority-low">Low</label>
									</div>
									<div class="4u 12u$(small)">
										<input type="radio" id="demo-priority-normal" name="demo-priority">
										<label for="demo-priority-normal">Normal</label>
									</div>
									<div class="4u$ 12u$(small)">
										<input type="radio" id="demo-priority-high" name="demo-priority">
										<label for="demo-priority-high">High</label>
									</div>
									<div class="6u 12u$(small)">
										<input type="checkbox" id="demo-copy" name="demo-copy">
										<label for="demo-copy">Email me a copy</label>
									</div>
									<div class="6u$ 12u$(small)">
										<input type="checkbox" id="demo-human" name="demo-human" checked>
										<label for="demo-human">Not a robot</label>
									</div>
									<div class="12u$">
										<textarea name="demo-message" id="demo-message" placeholder="Enter your message" rows="6"></textarea>
									</div>
									<div class="12u$">
										<ul class="actions">
											<li><input type="submit" value="Send Message" class="special" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
									</div>
								</div>
							</form>
						</section>

						<section>
							<h4>Image</h4>
							<h5>Fit</h5>
							<div class="box alt">
								<div class="row uniform 50%">
									<div class="12u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
									<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
									<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
									<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
									<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
									<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
									<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
									<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
									<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
									<div class="4u"><span class="image fit"><img src="images/pic04.jpg" alt="" /></span></div>
								</div>
							</div>
							<h5>Left &amp; Right</h5>
							<p><span class="image left"><img src="images/pic05.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent.</p>
							<p><span class="image right"><img src="images/pic05.jpg" alt="" /></span>Fringilla nisl. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent. Donec accumsan interdum nisi, quis tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent tincidunt felis sagittis eget. tempus euismod. Vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing accumsan eu faucibus. Integer ac pellentesque praesent.</p>
						</section>

					</div>
					<a href="#footer" class="goto-next scrolly">Next</a>
				</div>
			</section>
		-->

		<!-- Footer -->
			<section id="footer">
				<div class="container">
					<header class="major">
						<h2>会計専用ページ</h2>
					</header>
					<form method="post" action="login_act.php" >
						<div class="row uniform">
							<div class="6u 12u$(xsmall)">
								<select class="form-control" name="kaikei_years" >
							        <option　value="38">38期</option>
							        <option value="37">37期</option>
							        <option value="36">36期</option>
							        <option value="35">35期</option>
							    </select></div>
							<div class="6u$ 12u$(xsmall)"><input type="password" name="password" id="password" placeholder="パスワード" /></div>
							<div class="12u$">
								<ul class="actions">
									<li><input type="button" value="ログイン" class="special" onclick="return chk3(this.form)" /></li>
								</ul>

								<script type="text/javascript">
								    function chk3(frm){
								        if(frm.elements["password"].value!="kaikei"){
								            sweetAlert("パスワードが違います","", "error");
								            // alert("テキストボックスに入力してください");
								        }else{
								            /* submitメソッドでフォーム送信 */
								            frm.submit();
								        }
								    }
								</script>


							</div>
						</div>
					</form>
				</div>
				<footer>
					<ul class="icons">
						<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon alt fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li><li>Demo Images: <a href="http://unsplash.com">Unsplash</a></li>
					</ul>
				</footer>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>