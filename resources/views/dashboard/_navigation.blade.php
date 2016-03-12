<ul class="nav nav-pills nav-stacked">
    <li class="small text-uppercase">Compte</li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.index' ? 'active' : '' }}" href="{{ route('dashboard.index') }}"><span class="fa fa-user fa-fw"></span> Aperçu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.edit' ? 'active' : '' }}" href="/dashboard/edit"><span class="fa fa-cog fa-fw"></span> Modifier</a>
    </li>
    <li class="small text-uppercase">Paiements</li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.billing.index' ? 'active' : '' }}" href="#"><span class="fa fa-dollar fa-fw"></span> Aperçu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.billing.subscription' ? 'active' : '' }}" href="#"><span class="fa fa-rocket fa-fw"></span> Souscription</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.billing.invoices' ? 'active' : '' }}" href="#"><span class="fa fa-file fa-fw"></span> Paiements</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.billing.creditcard' ? 'active' : '' }}" href="#"><span class="fa fa-credit-card fa-fw"></span> Carte de crédit</a>
    </li>
    <li class="small text-uppercase">Autre</li>
    <li class="nav-item">
        <a class="nav-link bg-danger {{ Request::route()->getName() === 'dashboard.deactivate' ? 'active' : '' }}" href="#"><span class="fa fa-ban fa-fw"></span>Désactiver mon compte</a>
    </li>
</ul>