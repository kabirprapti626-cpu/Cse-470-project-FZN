<nav
    style="
        position: sticky;
        top: 0;
        z-index: 1000;
        background: linear-gradient(135deg, rgba(2,6,23,0.96), rgba(15,23,42,0.96));
        backdrop-filter: blur(14px);
        padding: 14px 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(148,163,184,0.12);
        box-shadow: 0 25px 60px rgba(0,0,0,0.7);
    "
>
    <!-- BRAND -->
    <div>
        <a href="{{ route('dashboard') }}"
           style="
                color: #60a5fa;
                font-weight: 800;
                font-size: 20px;
                letter-spacing: 0.6px;
                text-decoration: none;
                text-shadow: 0 0 14px rgba(96,165,250,0.45);
                transition: 0.25s ease;
           "
           onmouseover="this.style.color='#93c5fd'"
           onmouseout="this.style.color='#60a5fa'"
        >
            🚗 Car Store
        </a>
    </div>

    <!-- USER + LOGOUT -->
    <div style="display:flex; align-items:center; gap:18px;">

        <!-- USER BADGE -->
        <span
            style="
                color: #e5e7eb;
                font-size: 14px;
                padding: 6px 14px;
                border-radius: 999px;
                background: rgba(79,70,229,0.15);
                border: 1px solid rgba(79,70,229,0.35);
                box-shadow: inset 0 0 14px rgba(79,70,229,0.25);
                font-weight: 600;
            "
        >
            {{ Auth::user()->name }}
        </span>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit"
                style="
                    background: linear-gradient(135deg, #2563eb, #4f46e5);
                    border: none;
                    padding: 8px 18px;
                    border-radius: 12px;
                    font-weight: 700;
                    font-size: 13px;
                    cursor: pointer;
                    color: #ffffff;
                    box-shadow: 0 12px 28px rgba(79,70,229,0.5);
                    transition: all 0.25s ease;
                "
                onmouseover="
                    this.style.transform='translateY(-2px)';
                    this.style.boxShadow='0 18px 45px rgba(79,70,229,0.7)';
                "
                onmouseout="
                    this.style.transform='translateY(0)';
                    this.style.boxShadow='0 12px 28px rgba(79,70,229,0.5)';
                "
            >
                Logout
            </button>
        </form>
    </div>
</nav>
