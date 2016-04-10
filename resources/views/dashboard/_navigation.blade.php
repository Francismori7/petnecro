<ul class="nav nav-pills nav-stacked">
    <li class="subtitle">Compte</li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.index' ? 'active' : '' }}"
           href="{{ route('dashboard.index') }}"><span class="fa fa-search fa-fw"></span> Aperçu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.edit.profile' ? 'active' : '' }}"
           href="{{ route('dashboard.edit.profile') }}"><span class="fa fa-cog fa-fw"></span> Modifier le profil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.edit.account' ? 'active' : '' }}"
           href="{{ route('dashboard.edit.account') }}"><span class="fa fa-user-secret fa-fw"></span> Modifier le compte</a>
    </li>
    <li class="subtitle">Paiements</li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.billing.subscription' ? 'active' : '' }}"
           href="{{ route('dashboard.billing.subscription') }}"><span class="fa fa-rocket fa-fw"></span> Abonnement</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.billing.invoices.index' ? 'active' : '' }}"
           href="{{ route('dashboard.billing.invoices.index') }}"><span class="fa fa-file fa-fw"></span> Factures</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.billing.creditcard.edit' ? 'active' : '' }}"
           href="{{ route('dashboard.billing.creditcard.edit') }}"><span class="fa fa-credit-card fa-fw"></span> Carte de crédit</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ Request::route()->getName() === 'dashboard.billing.discount.edit' ? 'active' : '' }}"
           href="{{ route('dashboard.billing.discount.edit') }}"><span class="fa fa-dollar fa-fw"></span> Réductions</a>
    </li>
    <li class="subtitle">Autre</li>
    <li class="nav-item">
        <a class="nav-link bg-danger {{ Request::route()->getName() === 'dashboard.deactivate' ? 'active' : '' }}"
           href="#"><span class="fa fa-ban fa-fw"></span>Désactiver mon compte</a>
    </li>
</ul>