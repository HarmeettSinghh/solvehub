{{-- Reusable Stat Card Component --}}
{{-- Usage: @include('components.stat-card', ['label' => 'Label', 'value' => '123', 'trend' => '+12%', 'trendIcon' => 'arrow_upward', 'highlight' => true]) --}}

<div class="bg-surface-container-low border border-outline-variant p-5 rounded-lg">
    <p class="text-[10px] font-mono text-on-surface-variant uppercase tracking-wider mb-3">{{ $label ?? 'Stat' }}</p>
    <p class="stat-number {{ ($highlight ?? false) ? 'text-primary' : 'text-on-surface' }}">{{ $value ?? '0' }}</p>
    @if(isset($trend))
        <p class="mt-4 flex items-center text-xs font-mono text-secondary">
            <span class="material-symbols-outlined text-[14px] mr-1">{{ $trendIcon ?? 'trending_flat' }}</span>
            {{ $trend }}
        </p>
    @endif
</div>
