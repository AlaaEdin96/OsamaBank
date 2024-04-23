<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

		<title>A simple, clean, and responsive HTML invoice template</title>

		<style>
body{
	font-family: 'XBRiyaz',sans-serif;
}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				font-size: 16px;
				line-height: 24px;
				font-family: 'XBRiyaz',sans-serif;		
						color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: 'XBRiyaz',sans-serif;			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>


@php
	$account= App\Models\BankAccount::find($id);
@endphp

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title">
									<img
										src="https://sparksuite.github.io/simple-html-invoice-template/images/logo.png"
										style="width: 100%; max-width: 300px"
									/>
								</td>

								<td>
									Invoice #: {{$id}}<br />
									{{date('d-m-Y', strtotime($date["created_at" ]))}}<br />
 								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									Altamayuz.co<br />
									Tripoli , suq aljameih<br />
									Phone, 091783245
								</td>

								<td>
									 <br />
									نمودج شراء حساب الاغراض الشخصية<br />
 								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="heading">
					<td>البيان</td>

					<td>الوصف #</td>
				</tr>

				<tr class="item">
					<td>{{$account->name}}</td>

					<td>الاسم</td>
				</tr>

				<tr class="item">

					<td>{{$account->phone_contact}}</td>
					<td>هاتف التواصل</td>

				</tr>
 				<tr class="item">
					<td>{{ $account->bank->name }}</td>
					<td>المصرف </td>

				</tr>

				<tr class="item">
					<td>{{$account->phone}}</td>
					<td>رقم الهاتف المربوط بالمنصه </td>
				</tr>

				<tr class="item">
					<td>{{$account->numder_id}}</td>
					<td>الرقم الوطني </td>
				</tr>

				<tr class="item">
					<td>{{$date["id_card"]}}</td>
					<td>الجواز</td>
				</tr>
			</table>
		</div>
 	</body>
</html>