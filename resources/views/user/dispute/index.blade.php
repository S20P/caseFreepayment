@extends('user.layouts.master')
@section('page_title',__('Dispute List'))

@section('content')
	<div class="main-content">
		<section class="section">
			<div class="section-header">
				<h1>@lang('Dispute List')</h1>
				<div class="section-header-breadcrumb">
					<div class="breadcrumb-item active">
						<a href="{{ route('user.dashboard') }}">@lang('Dashboard')</a>
					</div>
					<div class="breadcrumb-item">@lang('Dispute List')</div>
				</div>
			</div>

			<div class="row mb-3">
				<div class="container-fluid" id="container-wrapper">
					<div class="row">
						<div class="col-lg-12">
							<div class="card mb-4 card-primary shadow-sm">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">@lang('Search')</h6>
								</div>
								<div class="card-body">
									<form action="{{ route('user.dispute.search') }}" method="get">
										@include('user.dispute.searchForm')
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="card mb-4 card-primary shadow">
								<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
									<h6 class="m-0 font-weight-bold text-primary">@lang('Dispute List')</h6>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped table-hover align-items-center table-borderless">
											<thead class="thead-light">
											<tr>
												<th>@lang('Dispute For')</th>
												<th>@lang('Dispute ID')</th>
												<th>@lang('Status')</th>
												<th>@lang('Created time')</th>
												<th>@lang('Action')</th>
											</tr>
											</thead>
											<tbody>
											@forelse($disputes as $key => $value)
												<tr>
													<td data-label="@lang('Dispute For')">
														@if($value->disputable_type == \App\Models\Escrow::class)
															<a href="{{ route('escrow.paymentView',optional($value->disputable)->utr) }}">@lang('Escrow')</a>
														@endif
													</td>
													<td data-label="@lang('Dispute ID')">{{ __($value->utr) }}</td>
													<td data-label="@lang('Status')">
														@if($value->status == 0)
															<span class="badge badge-success">@lang('Open')</span>
														@elseif($value->status == 1)
															<span class="badge badge-info">@lang('Solved')</span>
														@elseif($value->status == 2)
															<span class="badge badge-danger">@lang('Close')</span>
														@endif
													</td>
													<td data-label="@lang('Created time')">{{ dateTime($value->created_at)}}</td>
													<td data-label="@lang('Action')">
														<a href="{{ route('user.dispute.view',optional($value->disputable)->utr) }}"
														class="btn btn-sm btn-outline-primary">@lang('View')</a>
													</td>
												</tr>
											@empty
												<tr>
													<th colspan="100%" class="text-center">@lang('No data found')</th>
												</tr>
											@endforelse
											</tbody>
										</table>
									</div>
									<div class="card-footer">
										{{ $disputes->links() }}
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>
	</div>
@endsection
