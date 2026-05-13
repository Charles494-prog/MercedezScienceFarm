<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercedes Science Farm</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --purple:       #5c3494;
            --purple-mid:   #7248b8;
            --purple-light: #9a72d4;
            --purple-pale:  #f0eaf9;
            --orange:       #c95e0c;
            --orange-light: #e5864a;
            --orange-pale:  #fdf3ec;
            --green:        #286e30;
            --green-light:  #44a050;
            --green-pale:   #eaf4eb;
            --gold:         #a8841e;
            --gold-light:   #c9a53a;
            --gold-pale:    #fdf7e3;
            --dark:         #0f0a1e;
            --dark-mid:     #1a1133;
            --dark-card:    #1e1540;
            --white:        #ffffff;
            --off-white:    #f7f5fb;
            --text:         #1a1133;
            --text-mid:     #4a3f62;
            --text-light:   #8278a0;
            --nav-h:        68px;
            --pink:         #c0396a;
            --pink-light:   #e05a88;
            --pink-pale:    #fdeef4;
            --vm-bg:        #faf6ee;
            --vm-ink:       #2c1f0e;
            --vm-gold:      #9a7520;
            --vm-gold-lt:   #c4a040;
            --vm-border:    rgba(154,117,32,0.25);
        }
        html { scroll-behavior: smooth; }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--off-white);
            color: var(--text);
            overflow-x: hidden;
        }

        /* ─── SCROLL PROGRESS ───────────────────────────────── */
        #scroll-progress {
            position: fixed; top: 0; left: 0; height: 3px; z-index: 999;
            background: linear-gradient(90deg, var(--gold), var(--purple-mid), var(--green-light));
            width: 0%; transition: width 0.1s linear;
            border-radius: 0 2px 2px 0;
        }

        /* ─── SCROLL REVEAL ─────────────────────────────────── */
        .reveal { opacity: 0; transform: translateY(32px); transition: opacity 0.75s cubic-bezier(0.22,1,0.36,1), transform 0.75s cubic-bezier(0.22,1,0.36,1); }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-40px); transition: opacity 0.75s cubic-bezier(0.22,1,0.36,1), transform 0.75s cubic-bezier(0.22,1,0.36,1); }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(40px); transition: opacity 0.75s cubic-bezier(0.22,1,0.36,1), transform 0.75s cubic-bezier(0.22,1,0.36,1); }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }

        /* ─── NAV ───────────────────────────────────────────── */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 200;
            height: var(--nav-h);
            display: flex; justify-content: space-between; align-items: center;
            padding: 0 4rem;
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(92,52,148,0.1);
            box-shadow: 0 2px 24px rgba(92,52,148,0.06);
            transition: box-shadow 0.3s, background 0.3s;
        }
        nav.scrolled { box-shadow: 0 4px 32px rgba(92,52,148,0.12); background: rgba(255,255,255,0.99); }
        .nav-brand { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; }
        .nav-logo-img { width: 44px; height: 44px; object-fit: contain; }
        .nav-name { font-family: 'Lora', serif; font-size: 0.95rem; line-height: 1.2; }
        .nav-name .line1 { color: var(--purple); display: block; font-weight: 700; }
        .nav-name .line2 { color: var(--orange); display: block; font-weight: 600; font-style: italic; }
        .nav-links { display: flex; gap: 0.25rem; list-style: none; }
        .nav-links a {
            font-size: 0.84rem; font-weight: 500; letter-spacing: 0.03em;
            color: var(--text-mid); text-decoration: none;
            padding: 0.45rem 1rem; border-radius: 5px;
            transition: background 0.2s, color 0.2s;
            position: relative;
        }
        .nav-links a::after {
            content: ''; position: absolute; bottom: 4px; left: 1rem; right: 1rem;
            height: 2px; background: var(--purple); border-radius: 2px;
            transform: scaleX(0); transition: transform 0.25s cubic-bezier(0.22,1,0.36,1);
            transform-origin: left;
        }
        .nav-links a:hover { background: var(--purple-pale); color: var(--purple); }
        .nav-links a:hover::after { transform: scaleX(1); }
        .nav-toggle { display: none; flex-direction: column; gap: 5px; cursor: pointer; background: none; border: none; padding: 4px; }
        .nav-toggle span { display: block; width: 22px; height: 2px; background: var(--text); border-radius: 2px; transition: all 0.3s; }

        /* ─── HERO ──────────────────────────────────────────── */
        .hero { padding-top: var(--nav-h); min-height: 100vh; display: grid; grid-template-columns: 1fr 1fr; position: relative; overflow: hidden; }
        .hero-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 55% 70% at 78% 52%, rgba(92,52,148,0.07) 0%, transparent 65%), radial-gradient(ellipse 35% 50% at 10% 18%, rgba(40,110,48,0.05) 0%, transparent 55%); pointer-events: none; }
        .hero-grain { position: absolute; inset: 0; pointer-events: none; opacity: 0.025; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E"); background-size: 200px; }
        .hero-right { display: flex; align-items: center; justify-content: center; padding: 4rem 5rem 4rem 2rem; position: relative; z-index: 1; }
        .hero-img-wrap { position: relative; width: 100%; max-width: 400px; }
        .hero-img-ring { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 92%; aspect-ratio: 1; border-radius: 50%; border: 1px dashed rgba(92,52,148,0.18); animation: spin-slow 30s linear infinite; }
        .hero-img-ring-2 { position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 74%; aspect-ratio: 1; border-radius: 50%; background: radial-gradient(circle, rgba(92,52,148,0.06) 0%, transparent 70%); }
        @keyframes spin-slow { to { transform: translate(-50%,-50%) rotate(360deg); } }
        .hero-img-wrap img { position: relative; z-index: 1; width: 100%; aspect-ratio: 1; object-fit: contain; display: block; filter: drop-shadow(0 16px 48px rgba(92,52,148,0.15)); animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
        .hero-left { display: flex; flex-direction: column; justify-content: center; padding: 5rem 3rem 5rem 6rem; position: relative; z-index: 1; }
        .hero-badge { display: inline-flex; align-items: center; gap: 0.5rem; background: var(--green-pale); color: var(--green); font-size: 0.7rem; font-weight: 600; letter-spacing: 0.14em; text-transform: uppercase; padding: 0.4rem 1rem; border-radius: 3px; margin-bottom: 1.5rem; width: fit-content; border: 1.5px solid rgba(40,110,48,0.2); }
        .hero-since { font-family: 'Lora', serif; font-style: italic; font-size: 0.9rem; color: var(--gold); font-weight: 500; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }
        .hero-since::before { content: ''; display: inline-block; width: 28px; height: 1px; background: var(--gold); }
        .hero-title { font-family: 'Lora', serif; font-size: clamp(2.2rem, 4.2vw, 3.6rem); font-weight: 700; line-height: 1.12; margin-bottom: 1.4rem; color: var(--dark); }
        .hero-title .ap { color: var(--purple); }
        .hero-title .ag { color: var(--green); }
        .hero-desc { font-size: 0.975rem; color: var(--text-mid); line-height: 1.9; max-width: 440px; margin-bottom: 2.25rem; }

        /* ─── EYEBROW / SECTION TITLE ───────────────────────── */
        .eyebrow { display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.7rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.875rem; }
        .eyebrow::before { content: ''; display: inline-block; width: 22px; height: 2px; border-radius: 2px; background: currentColor; flex-shrink: 0; }
        .eyebrow.purple { color: var(--purple); }
        .eyebrow.orange { color: var(--orange); }
        .eyebrow.green  { color: var(--green); }
        .eyebrow.gold   { color: var(--gold); }
        .eyebrow.pink   { color: var(--pink); }
        .eyebrow.white  { color: rgba(255,255,255,0.55); }
        .eyebrow.center { justify-content: center; }
        .eyebrow.center::before { display: none; }
        .section-title { font-family: 'Lora', serif; font-weight: 700; font-size: clamp(1.55rem, 2.7vw, 2.15rem); color: var(--dark); line-height: 1.2; margin-bottom: 1.15rem; }
        .section-body { font-size: 0.95rem; color: var(--text-mid); line-height: 1.9; margin-bottom: 1.875rem; }

        /* ─── ACCREDITATION ─────────────────────────────────── */
        .accreditation { background: var(--dark); padding: 6rem; position: relative; overflow: hidden; }
        .accred-orb { position: absolute; border-radius: 50%; pointer-events: none; filter: blur(80px); opacity: 0.18; }
        .accred-orb-1 { width:500px;height:500px;background:var(--purple);top:-200px;left:-150px;animation:orb-drift1 12s ease-in-out infinite; }
        .accred-orb-2 { width:380px;height:380px;background:var(--green);bottom:-120px;right:-100px;animation:orb-drift2 10s ease-in-out infinite; }
        .accred-orb-3 { width:250px;height:250px;background:var(--gold);top:40%;left:55%;animation:orb-drift3 14s ease-in-out infinite; }
        @keyframes orb-drift1 { 0%,100%{transform:translate(0,0)}50%{transform:translate(60px,40px)} }
        @keyframes orb-drift2 { 0%,100%{transform:translate(0,0)}50%{transform:translate(-50px,-30px)} }
        @keyframes orb-drift3 { 0%,100%{transform:translate(0,0)}50%{transform:translate(30px,-50px)} }
        .accred-inner { position:relative;z-index:1;max-width:1140px;margin:0 auto; }
        .accred-header { text-align:center;margin-bottom:1rem; }
        .accred-lead { text-align:center; font-family:'Lora',serif; font-style:italic; font-size:1.1rem; color:rgba(255,255,255,0.45); margin-bottom:3.5rem; max-width:540px; margin-left:auto; margin-right:auto; }
        .accred-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:1.75rem; max-width:980px; margin:0 auto; }
        .accred-card { background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); border-radius:12px; padding:2.25rem; display:flex; gap:1.5rem; align-items:flex-start; position:relative; overflow:hidden; transition:background 0.3s, border-color 0.3s, transform 0.4s cubic-bezier(0.22,1,0.36,1), box-shadow 0.3s; cursor:default; }
        .accred-card::before { content:''; position:absolute; top:0; left:0; right:0; height:3px; border-radius:12px 12px 0 0; transition:opacity 0.3s; }
        .accred-card.da::before    { background:linear-gradient(90deg,#d4b04a,#f0d080); }
        .accred-card.ati::before   { background:linear-gradient(90deg,#7248b8,#a87ce0); }
        .accred-card.rcef::before  { background:linear-gradient(90deg,#286e30,#44a050); }
        .accred-card.lsa::before   { background:linear-gradient(90deg,#c95e0c,#e5864a); }
        .accred-card.tesda::before { background:linear-gradient(90deg,#0a5c96,#1a8ac8); }
        .accred-card:hover { background:rgba(255,255,255,0.07); border-color:rgba(255,255,255,0.15); transform:translateY(-6px); box-shadow:0 20px 60px rgba(0,0,0,0.3); }
        .accred-card::after { content:''; position:absolute; inset:0; background:linear-gradient(120deg,transparent 30%,rgba(255,255,255,0.04) 50%,transparent 70%); transform:translateX(-100%); transition:transform 0.6s ease; }
        .accred-card:hover::after { transform:translateX(100%); }
        .accred-logo-box { width:88px; height:88px; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0; background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.1); overflow:hidden; transition:transform 0.3s; }
        .accred-card:hover .accred-logo-box { transform:scale(1.08) rotate(-2deg); }
        .accred-logo-box svg { width:70px; height:70px; }
        .accred-card-text { flex:1; }
        .accred-acronym { font-family:'Lora',serif; font-size:1.3rem; font-weight:700; color:var(--white); margin-bottom:0.2rem; letter-spacing:0.03em; }
        .accred-fullname { font-size:0.8rem; font-weight:600; letter-spacing:0.12em; text-transform:uppercase; margin-bottom:0.75rem; }
        .accred-card.da    .accred-fullname { color:var(--gold-light); }
        .accred-card.ati   .accred-fullname { color:var(--purple-light); }
        .accred-card.rcef  .accred-fullname { color:var(--green-light); }
        .accred-card.lsa   .accred-fullname { color:var(--orange-light); }
        .accred-card.tesda .accred-fullname { color:#6abde8; }
        .accred-desc { font-size:0.875rem; color:rgba(255,255,255,0.5); line-height:1.8; }
        .accred-tag { display:inline-block; margin-top:0.875rem; font-size:0.68rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; padding:0.28rem 0.75rem; border-radius:3px; }
        .accred-card.da    .accred-tag { background:rgba(212,176,74,0.12); color:var(--gold-light); border:1px solid rgba(212,176,74,0.25); }
        .accred-card.ati   .accred-tag { background:rgba(114,72,184,0.15); color:var(--purple-light); border:1px solid rgba(114,72,184,0.25); }
        .accred-card.rcef  .accred-tag { background:rgba(40,110,48,0.15); color:var(--green-light); border:1px solid rgba(40,110,48,0.3); }
        .accred-card.lsa   .accred-tag { background:rgba(201,94,12,0.15); color:var(--orange-light); border:1px solid rgba(201,94,12,0.25); }
        .accred-card.tesda .accred-tag { background:rgba(10,92,150,0.2); color:#6abde8; border:1px solid rgba(10,92,150,0.35); }
        .accred-card.tesda { grid-column:1/-1; max-width:980px; }
        .accred-since { text-align:center; margin-top:3.5rem; padding-top:3rem; border-top:1px solid rgba(255,255,255,0.07); display:flex; justify-content:center; gap:4rem; flex-wrap:wrap; }
        .since-item { text-align:center; }
        .since-number { font-family:'Lora',serif; font-size:2.5rem; font-weight:700; color:var(--white); display:block; line-height:1; margin-bottom:0.35rem; }
        .since-number span { color:var(--purple-light); }
        .since-label { font-size:0.72rem; font-weight:600; letter-spacing:0.18em; text-transform:uppercase; color:rgba(255,255,255,0.35); }
        .since-ordinal { font-size:1.4rem; vertical-align:super; color:var(--gold-light); }

        /* ─── ABOUT ─────────────────────────────────────────── */
        .about { display:grid; grid-template-columns:1fr 1fr; min-height:520px; }
        .about-img { background:var(--purple-pale); position:relative; overflow:hidden; min-height:400px; }
        .about-img img { width:100%; height:100%; object-fit:cover; display:block; }
        .about-img-anim { position:absolute; inset:0; z-index:2; pointer-events:none; overflow:hidden; }
        .anim-particle { position:absolute; border-radius:50%; opacity:0; animation:particle-rise var(--dur,6s) ease-in-out var(--delay,0s) infinite; }
        @keyframes particle-rise { 0%{opacity:0;transform:translateY(0) scale(0.5)}20%{opacity:0.6}80%{opacity:0.3}100%{opacity:0;transform:translateY(-80px) scale(1.2)} }
        .anim-scanline { position:absolute; left:0; right:0; height:3px; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.3),transparent); animation:scanline 4s ease-in-out infinite; }
        @keyframes scanline { 0%{top:100%;opacity:0}10%{opacity:1}90%{opacity:1}100%{top:-10px;opacity:0} }
        .anim-corner { position:absolute; width:80px; height:80px; background:radial-gradient(circle,rgba(92,52,148,0.4) 0%,transparent 70%); animation:corner-pulse 3s ease-in-out infinite; }
        .anim-corner.tl{top:0;left:0}.anim-corner.br{bottom:0;right:0;animation-delay:1.5s}
        @keyframes corner-pulse { 0%,100%{opacity:0.3;transform:scale(1)}50%{opacity:0.9;transform:scale(1.6)} }
        .about-img-badge { position:absolute; bottom:0; left:0; right:0; z-index:3; padding:1rem 1.5rem; background:linear-gradient(to top,rgba(15,10,30,0.85),transparent); display:flex; align-items:flex-end; gap:0.5rem; }
        .about-img-badge-pill { font-size:0.65rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; color:var(--white); background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2); border-radius:3px; padding:0.25rem 0.65rem; animation:pill-appear 0.5s ease both; }
        .about-img-badge-pill:nth-child(1){animation-delay:0.3s}.about-img-badge-pill:nth-child(2){animation-delay:0.5s}.about-img-badge-pill:nth-child(3){animation-delay:0.7s}
        @keyframes pill-appear { from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)} }
        .about-content { padding:5rem; display:flex; flex-direction:column; justify-content:center; background:var(--white); }
        .partner-row { display:flex; flex-wrap:wrap; gap:0.5rem; margin-top:1.5rem; }
        .partner-badge { display:inline-flex; align-items:center; gap:0.4rem; font-size:0.65rem; font-weight:700; letter-spacing:0.12em; text-transform:uppercase; padding:0.3rem 0.8rem; border-radius:3px; border:1.5px solid; }
        .partner-badge.da    { color:var(--gold);   border-color:rgba(168,132,30,0.35); background:var(--gold-pale); }
        .partner-badge.ati   { color:var(--purple); border-color:rgba(92,52,148,0.3);   background:var(--purple-pale); }
        .partner-badge.rcef  { color:var(--green);  border-color:rgba(40,110,48,0.3);   background:var(--green-pale); }
        .partner-badge.lsa   { color:var(--orange); border-color:rgba(201,94,12,0.3);   background:var(--orange-pale); }
        .partner-badge.tesda { color:#0a5c96;       border-color:rgba(10,92,150,0.3);   background:#eaf4fb; }

        /* ─── SWAIB ─────────────────────────────────────────── */
        .swaib-section {
            padding: 7rem 6rem;
            background: var(--off-white);
            position: relative; overflow: hidden;
        }
        .swaib-section::before { content:''; position:absolute; top:-120px; right:-120px; width:500px; height:500px; border-radius:50%; background:radial-gradient(circle,rgba(192,57,106,0.06) 0%,transparent 65%); pointer-events:none; }
        .swaib-section::after { content:''; position:absolute; bottom:-80px; left:-60px; width:320px; height:320px; border-radius:50%; background:radial-gradient(circle,rgba(92,52,148,0.05) 0%,transparent 65%); pointer-events:none; }
        .swaib-intro { max-width:1100px; margin:0 auto 4rem; display:grid; grid-template-columns:1fr 1.2fr; gap:4rem; align-items:center; }
        .swaib-name { font-family:'Lora',serif; font-size:clamp(1.8rem,3vw,2.8rem); font-weight:700; color:var(--dark); line-height:1.15; margin-bottom:0.5rem; }
        .swaib-name .accent { color:var(--pink); }
        .swaib-acronym-row { display:flex; align-items:center; gap:0.75rem; margin-bottom:1.5rem; flex-wrap:wrap; }
        .swaib-acronym-pill { font-size:0.65rem; font-weight:800; letter-spacing:0.18em; text-transform:uppercase; padding:0.3rem 0.875rem; border-radius:2px; background:var(--pink); color:var(--white); }
        .swaib-tagline { font-family:'Lora',serif; font-style:italic; font-size:0.95rem; color:var(--text-mid); }
        .swaib-intro-body { font-size:0.95rem; color:var(--text-mid); line-height:1.9; }
        .swaib-stats { display:flex; gap:2rem; flex-wrap:wrap; margin-top:2rem; padding-top:2rem; border-top:1px solid rgba(0,0,0,0.07); }
        .swaib-stat-num { font-family:'Lora',serif; font-size:1.8rem; font-weight:700; color:var(--pink); display:block; line-height:1; }
        .swaib-stat-label { font-size:0.72rem; font-weight:600; letter-spacing:0.14em; text-transform:uppercase; color:var(--text-light); }
        .swaib-highlight-card { background:var(--white); border:1px solid rgba(192,57,106,0.12); border-radius:12px; padding:2.5rem; box-shadow:0 8px 40px rgba(192,57,106,0.08); position:relative; overflow:hidden; }
        .swaib-highlight-card::before { content:''; position:absolute; top:0; left:0; right:0; height:4px; background:linear-gradient(90deg,var(--pink),var(--purple-mid)); border-radius:12px 12px 0 0; }
        .swaib-highlight-card h4 { font-family:'Lora',serif; font-size:1.05rem; font-weight:700; color:var(--dark); margin-bottom:1.25rem; }
        .swaib-benefit-list { list-style:none; display:flex; flex-direction:column; gap:0.875rem; }
        .swaib-benefit-list li { display:flex; gap:0.75rem; align-items:flex-start; font-size:0.875rem; color:var(--text-mid); line-height:1.7; }
        .swaib-benefit-icon { width:22px;height:22px;border-radius:50%;background:var(--pink-pale);color:var(--pink);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px; }
        .swaib-benefit-icon svg { width:11px;height:11px; }

        /* ─── SWAIB RESULT CARDS (replaces gallery) ─────────── */
        .swaib-results {
            max-width: 1100px; margin: 0 auto;
        }
        .swaib-results-heading {
            text-align: center; margin-bottom: 2.5rem;
        }
        .swaib-results-heading h3 {
            font-family: 'Lora', serif; font-size: 1.4rem; font-weight: 700;
            color: var(--dark); margin-bottom: 0.4rem;
        }
        .swaib-results-heading p {
            font-size: 0.875rem; color: var(--text-light);
        }
        .swaib-result-cards {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem;
        }
        .swaib-result-card {
            background: var(--white);
            border: 1px solid rgba(0,0,0,0.07);
            border-radius: 14px;
            padding: 2rem 1.5rem;
            text-align: center;
            position: relative; overflow: hidden;
            transition: transform 0.35s cubic-bezier(0.22,1,0.36,1), box-shadow 0.35s, border-color 0.3s;
            cursor: default;
        }
        .swaib-result-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
            border-radius: 14px 14px 0 0;
        }
        .swaib-result-card:nth-child(1)::before { background: linear-gradient(90deg, var(--pink), var(--purple-mid)); }
        .swaib-result-card:nth-child(2)::before { background: linear-gradient(90deg, var(--green), var(--green-light)); }
        .swaib-result-card:nth-child(3)::before { background: linear-gradient(90deg, var(--gold), var(--orange-light)); }
        .swaib-result-card:nth-child(4)::before { background: linear-gradient(90deg, var(--purple), var(--purple-light)); }
        .swaib-result-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(0,0,0,0.1); border-color: rgba(0,0,0,0.12); }
        .src-icon {
            width: 52px; height: 52px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.1rem;
        }
        .swaib-result-card:nth-child(1) .src-icon { background: var(--pink-pale); color: var(--pink); }
        .swaib-result-card:nth-child(2) .src-icon { background: var(--green-pale); color: var(--green); }
        .swaib-result-card:nth-child(3) .src-icon { background: var(--gold-pale); color: var(--gold); }
        .swaib-result-card:nth-child(4) .src-icon { background: var(--purple-pale); color: var(--purple); }
        .src-icon svg { width: 22px; height: 22px; }
        .src-stat {
            font-family: 'Lora', serif; font-size: 2rem; font-weight: 700;
            line-height: 1; margin-bottom: 0.35rem;
        }
        .swaib-result-card:nth-child(1) .src-stat { color: var(--pink); }
        .swaib-result-card:nth-child(2) .src-stat { color: var(--green); }
        .swaib-result-card:nth-child(3) .src-stat { color: var(--gold); }
        .swaib-result-card:nth-child(4) .src-stat { color: var(--purple); }
        .src-title {
            font-size: 0.82rem; font-weight: 700; letter-spacing: 0.06em;
            color: var(--dark); margin-bottom: 0.6rem; text-transform: uppercase;
        }
        .src-desc {
            font-size: 0.8rem; color: var(--text-light); line-height: 1.65;
        }

        /* ─── AVAILABLE BREEDS (now under What We Offer) ────── */
        .breeds-section {
            width: 100%; padding: 0;
            background: linear-gradient(160deg, #0f1a0f 0%, #0d1408 50%, #111818 100%);
            position: relative; overflow: hidden;
        }
        .breeds-header-area { padding: 5rem 6rem 3rem; text-align: center; position: relative; z-index: 2; }
        .breeds-header-area .section-title { color: var(--white); margin-bottom: 0.5rem; }
        .breeds-subtitle { font-family: 'Lora', serif; font-style: italic; font-size: 1rem; color: rgba(255,255,255,0.4); margin-top: 0.5rem; }
        .breeds-grid { display: grid; grid-template-columns: 1fr 1fr; width: 100%; position: relative; z-index: 2; }
        .breed-panel { position: relative; overflow: hidden; aspect-ratio: 16/10; cursor: pointer; }
        .breed-panel-bg { position: absolute; inset: 0; transition: transform 0.7s cubic-bezier(0.22,1,0.36,1); }
        .breed-panel:hover .breed-panel-bg { transform: scale(1.06); }
        .breed-panel.gp1040 .breed-panel-bg { background: linear-gradient(135deg, #1a2e0a 0%, #0f1a06 100%); }
        .breed-panel.pic410 .breed-panel-bg { background: linear-gradient(135deg, #1c1a08 0%, #12100a 100%); }
        .breed-panel::before { content: ''; position: absolute; inset: 0; z-index: 1; pointer-events: none; background: radial-gradient(ellipse 60% 70% at 80% 50%, rgba(255,255,255,0.04) 0%, transparent 70%); }
        .breed-panel.gp1040::after { content: ''; position: absolute; top: 0; right: 0; bottom: 0; width: 1px; background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.15), transparent); z-index: 10; }
        .breed-panel-content { position: absolute; inset: 0; z-index: 5; display: flex; align-items: stretch; }
        .breed-info { width: 55%; padding: 3rem 2.5rem 3rem 3.5rem; display: flex; flex-direction: column; justify-content: center; position: relative; }
        .breed-pic-logo { display: flex; align-items: baseline; gap: 0.3rem; margin-bottom: 1.25rem; }
        .breed-pic-text { font-family: 'DM Sans', sans-serif; font-size: 1.1rem; font-weight: 800; letter-spacing: 0.08em; }
        .breed-panel.gp1040 .breed-pic-text { color: #c8f060; }
        .breed-panel.pic410 .breed-pic-text { color: #f0c840; }
        .breed-pic-reg { font-size: 0.5rem; vertical-align: super; opacity: 0.6; color: currentColor; }
        .breed-model-name { font-family: 'DM Sans', sans-serif; font-size: clamp(2rem, 3.5vw, 3.2rem); font-weight: 900; line-height: 1; letter-spacing: -0.02em; margin-bottom: 1.5rem; color: var(--white); }
        .breed-features { list-style: none; display: flex; flex-direction: column; gap: 1rem; }
        .breed-feature-item { display: flex; align-items: flex-start; gap: 0.875rem; }
        .breed-feature-icon { width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0; display: flex; align-items: center; justify-content: center; border: 1px solid; }
        .breed-panel.gp1040 .breed-feature-icon { background: rgba(200,240,96,0.1); border-color: rgba(200,240,96,0.3); }
        .breed-panel.pic410 .breed-feature-icon { background: rgba(240,200,64,0.1); border-color: rgba(240,200,64,0.3); }
        .breed-feature-icon svg { width: 16px; height: 16px; }
        .breed-panel.gp1040 .breed-feature-icon svg { color: #c8f060; }
        .breed-panel.pic410 .breed-feature-icon svg { color: #f0c840; }
        .breed-feature-title { font-size: 0.72rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase; display: block; margin-bottom: 0.1rem; }
        .breed-panel.gp1040 .breed-feature-title { color: #c8f060; }
        .breed-panel.pic410 .breed-feature-title { color: #f0c840; }
        .breed-feature-desc { font-size: 0.82rem; color: rgba(255,255,255,0.55); line-height: 1.5; }
        .breed-image-col { width: 45%; position: relative; overflow: hidden; }
        .breed-image-col img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s cubic-bezier(0.22,1,0.36,1); }
        .breed-panel.gp1040 .breed-image-col img { filter: saturate(1.1) brightness(0.92); }
        .breed-panel.pic410 .breed-image-col img { filter: saturate(1.05) brightness(0.90) sepia(0.08); }
        .breed-panel:hover .breed-image-col img { transform: scale(1.05); }
        .breed-image-col::before { content: ''; position: absolute; top: 0; left: 0; bottom: 0; width: 80px; z-index: 1; }
        .breed-panel.gp1040 .breed-image-col::before { background: linear-gradient(to right, #1a2e0a, transparent); }
        .breed-panel.pic410 .breed-image-col::before { background: linear-gradient(to right, #1c1a08, transparent); }
        .breed-hover-glow { position: absolute; inset: 0; z-index: 2; pointer-events: none; opacity: 0; transition: opacity 0.5s ease; }
        .breed-panel.gp1040 .breed-hover-glow { background: radial-gradient(ellipse 50% 60% at 20% 50%, rgba(200,240,96,0.06) 0%, transparent 70%); }
        .breed-panel.pic410 .breed-hover-glow { background: radial-gradient(ellipse 50% 60% at 20% 50%, rgba(240,200,64,0.06) 0%, transparent 70%); }
        .breed-panel:hover .breed-hover-glow { opacity: 1; }
        .breeds-bottom-bar { padding: 2.5rem 6rem; display: flex; align-items: center; justify-content: center; gap: 3rem; border-top: 1px solid rgba(255,255,255,0.06); flex-wrap: wrap; }
        .breeds-bottom-tag { display: flex; align-items: center; gap: 0.5rem; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.14em; text-transform: uppercase; color: rgba(255,255,255,0.35); }
        .breeds-bottom-tag::before { content: ''; display: inline-block; width: 4px; height: 4px; border-radius: 50%; background: currentColor; }

        /* ─── VISION & MISSION ──────────────────────────────── */
        .vision-mission { padding: 7rem 6rem; background: var(--vm-bg); position: relative; overflow: hidden; }
        .vision-mission::before { content: ''; position: absolute; inset: 0; pointer-events: none; z-index: 0; background-image: repeating-linear-gradient(0deg, transparent, transparent 48px, rgba(154,117,32,0.04) 48px, rgba(154,117,32,0.04) 49px), repeating-linear-gradient(90deg, transparent, transparent 48px, rgba(154,117,32,0.02) 48px, rgba(154,117,32,0.02) 49px); }
        .vision-mission::after { content: '✦'; position: absolute; top: 2.5rem; left: 50%; transform: translateX(-50%); font-size: 1.4rem; color: rgba(154,117,32,0.3); z-index: 1; letter-spacing: 1.2rem; }
        .vm-header { text-align: center; margin-bottom: 1.5rem; position: relative; z-index: 1; }
        .vm-header .eyebrow { color: var(--vm-gold); }
        .vm-header .eyebrow::before { background: var(--vm-gold); }
        .vm-header .section-title { color: var(--vm-ink); font-size: clamp(1.8rem, 3vw, 2.8rem); }
        .vm-rule { display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 3.5rem; position: relative; z-index: 1; }
        .vm-rule::before, .vm-rule::after { content: ''; flex: 1; max-width: 180px; height: 1px; background: linear-gradient(to right, transparent, var(--vm-gold)); }
        .vm-rule::after { background: linear-gradient(to left, transparent, var(--vm-gold)); }
        .vm-rule-ornament { font-size: 1.1rem; color: var(--vm-gold); letter-spacing: 0.5rem; }
        .vm-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem; max-width: 1000px; margin: 0 auto; position: relative; z-index: 1; }
        .vm-card { background: rgba(255,255,255,0.75); border: 1px solid var(--vm-border); border-radius: 4px; padding: 3rem; position: relative; overflow: hidden; box-shadow: 0 4px 32px rgba(154,117,32,0.08), inset 0 0 0 1px rgba(255,255,255,0.6); transition: transform 0.4s cubic-bezier(0.22,1,0.36,1), box-shadow 0.4s; }
        .vm-card:hover { transform: translateY(-4px); box-shadow: 0 12px 48px rgba(154,117,32,0.14), inset 0 0 0 1px rgba(255,255,255,0.8); }
        .vm-card::before, .vm-card::after { content: ''; position: absolute; width: 16px; height: 16px; border-color: var(--vm-gold); border-style: solid; opacity: 0.5; }
        .vm-card::before { top: 10px; left: 10px; border-width: 1px 0 0 1px; }
        .vm-card::after  { bottom: 10px; right: 10px; border-width: 0 1px 1px 0; }
        .vm-card-bar { position: absolute; top: 0; left: 0; right: 0; height: 3px; }
        .vm-card.vision  .vm-card-bar { background: linear-gradient(90deg, var(--vm-gold), var(--purple-light)); }
        .vm-card.mission .vm-card-bar { background: linear-gradient(90deg, var(--vm-gold), var(--green-light)); }
        .vm-card-icon { width: 52px; height: 52px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; border: 1.5px solid var(--vm-border); background: var(--gold-pale); }
        .vm-card-icon svg { width: 22px; height: 22px; }
        .vm-card-title { font-family: 'Cormorant Garamond', serif; font-size: 1.6rem; font-weight: 700; color: var(--vm-ink); margin-bottom: 0.5rem; letter-spacing: 0.01em; }
        .vm-card-divider { width: 40px; height: 1px; background: var(--vm-gold); margin-bottom: 1.25rem; opacity: 0.6; }
        .vm-card-body { font-size: 0.9rem; color: #5a4a2a; line-height: 1.95; font-family: 'DM Sans', sans-serif; }
        .vm-card-body ul { list-style: none; display: flex; flex-direction: column; gap: 0.75rem; }
        .vm-card-body ul li { display: flex; gap: 0.75rem; align-items: flex-start; }
        .vm-card-body ul li::before { content: '❧'; font-size: 0.8rem; color: var(--vm-gold); margin-top: 0.2rem; flex-shrink: 0; opacity: 0.7; }
        .vm-vision-quote { font-family: 'Cormorant Garamond', serif; font-style: italic; font-size: 1.05rem; line-height: 1.9; color: #4a3a1a; }

        /* ─── FEEDBACK ──────────────────────────────────────── */
        .feedback-section { padding:6rem; background:var(--white); position:relative; overflow:hidden; }
        .feedback-section::before { content:''; position:absolute; top:-100px; left:-100px; width:400px; height:400px; border-radius:50%; background:radial-gradient(circle,rgba(92,52,148,0.05) 0%,transparent 65%); pointer-events:none; }
        .feedback-header { text-align:center; margin-bottom:3.5rem; }
        .feedback-marquee-wrap { overflow:hidden; -webkit-mask-image:linear-gradient(to right,transparent 0%,black 8%,black 92%,transparent 100%); mask-image:linear-gradient(to right,transparent 0%,black 8%,black 92%,transparent 100%); }
        .feedback-track { display:flex; gap:1.5rem; width:max-content; animation:marquee-scroll 28s linear infinite; }
        .feedback-track:hover { animation-play-state:paused; }
        @keyframes marquee-scroll { 0%{transform:translateX(0)}100%{transform:translateX(-50%)} }
        .fb-card { background:var(--white); border:1px solid rgba(92,52,148,0.1); border-radius:14px; padding:1.75rem 1.875rem; width:300px; flex-shrink:0; position:relative; box-shadow:0 4px 24px rgba(92,52,148,0.07); transition:transform 0.3s,box-shadow 0.3s,border-color 0.3s; }
        .fb-card:hover { transform:translateY(-4px); box-shadow:0 12px 36px rgba(92,52,148,0.13); border-color:rgba(92,52,148,0.22); }
        .fb-quote-mark { position:absolute; top:1rem; right:1.25rem; font-family:'Lora',serif; font-size:4rem; line-height:1; color:var(--purple-pale); font-weight:700; user-select:none; }
        .fb-stars { display:flex; gap:2px; margin-bottom:0.875rem; }
        .fb-stars svg { width:13px; height:13px; }
        .fb-message { font-size:0.9rem; color:var(--text-mid); line-height:1.8; margin-bottom:1.25rem; position:relative; z-index:1; }
        .fb-author { display:flex; align-items:center; gap:0.75rem; padding-top:1rem; border-top:1px solid rgba(92,52,148,0.07); }
        .fb-avatar { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-family:'Lora',serif; font-size:0.85rem; font-weight:700; color:var(--white); flex-shrink:0; }
        .fb-name { font-size:0.82rem; font-weight:600; color:var(--dark); display:block; line-height:1.3; }
        .fb-source { display:inline-flex; align-items:center; gap:0.3rem; font-size:0.68rem; color:var(--text-light); letter-spacing:0.04em; }
        .fb-source svg { width:10px; height:10px; opacity:0.5; }
        .fb-avatar.v1{background:linear-gradient(135deg,#5c3494,#9a72d4)}
        .fb-avatar.v2{background:linear-gradient(135deg,#286e30,#44a050)}
        .fb-avatar.v3{background:linear-gradient(135deg,#c95e0c,#e5864a)}
        .fb-avatar.v4{background:linear-gradient(135deg,#a8841e,#c9a53a)}
        .fb-avatar.v5{background:linear-gradient(135deg,#c0396a,#e05a88)}

        /* ─── CTA BANNER ────────────────────────────────────── */
        .cta-banner { padding:5rem 6rem; background:linear-gradient(135deg,var(--purple) 0%,#2e1660 100%); display:flex; justify-content:space-between; align-items:center; gap:2rem; position:relative; overflow:hidden; }
        .cta-banner::before { content:''; position:absolute; top:-80px; right:-80px; width:360px; height:360px; border-radius:50%; background:rgba(255,255,255,0.04); }
        .cta-banner::after { content:''; position:absolute; bottom:-60px; left:28%; width:280px; height:280px; border-radius:50%; background:rgba(201,94,12,0.12); }
        .cta-text { position:relative; z-index:1; }
        .cta-text .section-title { color:var(--white); }
        .cta-text .section-body  { color:rgba(255,255,255,0.6); margin-bottom:0; }
        .btn-white { display:inline-flex;align-items:center;gap:0.5rem;padding:0.8rem 2.1rem;background:var(--white);color:var(--purple);font-family:'DM Sans',sans-serif;font-size:0.875rem;font-weight:700;border-radius:4px;text-decoration:none;flex-shrink:0;white-space:nowrap;transition:transform 0.2s,box-shadow 0.2s;box-shadow:0 4px 20px rgba(0,0,0,0.18);cursor:pointer;border:none; }
        .btn-white:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(0,0,0,0.22); }

        /* ─── CONTACT MODAL ─────────────────────────────────── */
        .contact-modal-overlay {
            position: fixed; inset: 0; z-index: 500;
            background: rgba(10, 5, 25, 0.72);
            backdrop-filter: blur(8px);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; pointer-events: none;
            transition: opacity 0.35s cubic-bezier(0.22,1,0.36,1);
        }
        .contact-modal-overlay.open {
            opacity: 1; pointer-events: all;
        }
        .contact-modal {
            background: var(--white);
            border-radius: 20px;
            padding: 2.75rem 2.5rem 2.5rem;
            width: 100%; max-width: 420px;
            position: relative;
            box-shadow: 0 32px 80px rgba(0,0,0,0.28), 0 0 0 1px rgba(92,52,148,0.08);
            transform: translateY(28px) scale(0.97);
            transition: transform 0.4s cubic-bezier(0.22,1,0.36,1), opacity 0.4s;
            opacity: 0;
        }
        .contact-modal-overlay.open .contact-modal {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
        /* Top accent bar */
        .contact-modal::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px;
            background: linear-gradient(90deg, var(--purple), var(--pink), var(--green-light));
            border-radius: 20px 20px 0 0;
        }
        .contact-modal-close {
            position: absolute; top: 1.25rem; right: 1.25rem;
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            background: var(--off-white); border: 1px solid rgba(0,0,0,0.07);
            cursor: pointer; color: var(--text-mid);
            transition: background 0.2s, color 0.2s, transform 0.2s;
        }
        .contact-modal-close:hover { background: var(--purple-pale); color: var(--purple); transform: rotate(90deg); }
        .contact-modal-close svg { width: 14px; height: 14px; }
        .contact-modal-eyebrow {
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.22em;
            text-transform: uppercase; color: var(--purple); margin-bottom: 0.4rem;
            display: flex; align-items: center; gap: 0.4rem;
        }
        .contact-modal-eyebrow::before { content: ''; display: inline-block; width: 18px; height: 2px; background: var(--purple); border-radius: 2px; }
        .contact-modal-title {
            font-family: 'Lora', serif; font-size: 1.5rem; font-weight: 700;
            color: var(--dark); margin-bottom: 0.4rem;
        }
        .contact-modal-subtitle {
            font-size: 0.82rem; color: var(--text-light); margin-bottom: 2rem; line-height: 1.6;
        }
        .contact-links { display: flex; flex-direction: column; gap: 0.875rem; }
        .contact-link-item {
            display: flex; align-items: center; gap: 1rem;
            padding: 1rem 1.25rem;
            border-radius: 12px;
            border: 1.5px solid;
            text-decoration: none;
            transition: transform 0.25s cubic-bezier(0.22,1,0.36,1), box-shadow 0.25s, background 0.2s;
            position: relative; overflow: hidden;
        }
        .contact-link-item::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(120deg, transparent 30%, rgba(255,255,255,0.5) 50%, transparent 70%);
            transform: translateX(-100%); transition: transform 0.5s ease;
        }
        .contact-link-item:hover::after { transform: translateX(100%); }
        .contact-link-item:hover { transform: translateX(4px); box-shadow: 0 6px 24px rgba(0,0,0,0.1); }

        /* Facebook */
        .contact-link-item.fb {
            background: rgba(24, 119, 242, 0.05);
            border-color: rgba(24, 119, 242, 0.2);
        }
        .contact-link-item.fb:hover { background: rgba(24, 119, 242, 0.1); border-color: rgba(24, 119, 242, 0.4); }
        .contact-link-item.fb .cli-icon { background: #1877f2; color: white; }
        .contact-link-item.fb .cli-label { color: #1877f2; }

        /* Location */
        .contact-link-item.loc {
            background: rgba(234, 67, 53, 0.04);
            border-color: rgba(234, 67, 53, 0.18);
        }
        .contact-link-item.loc:hover { background: rgba(234, 67, 53, 0.09); border-color: rgba(234, 67, 53, 0.35); }
        .contact-link-item.loc .cli-icon { background: #ea4335; color: white; }
        .contact-link-item.loc .cli-label { color: #ea4335; }

        /* Gmail */
        .contact-link-item.gm {
            background: rgba(234, 67, 53, 0.04);
            border-color: rgba(234, 67, 53, 0.18);
        }
        .contact-link-item.gm:hover { background: rgba(234, 67, 53, 0.09); border-color: rgba(234, 67, 53, 0.35); }
        .contact-link-item.gm .cli-icon { background: linear-gradient(135deg, #ea4335, #fbbc05); color: white; }
        .contact-link-item.gm .cli-label { color: #ea4335; }

        /* Phone */
        .contact-link-item.ph {
            background: rgba(40, 110, 48, 0.04);
            border-color: rgba(40, 110, 48, 0.18);
        }
        .contact-link-item.ph:hover { background: rgba(40, 110, 48, 0.09); border-color: rgba(40, 110, 48, 0.35); }
        .contact-link-item.ph .cli-icon { background: var(--green); color: white; }
        .contact-link-item.ph .cli-label { color: var(--green); }

        .cli-icon {
            width: 40px; height: 40px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .cli-icon svg { width: 20px; height: 20px; }
        .cli-text { flex: 1; min-width: 0; }
        .cli-label {
            font-size: 0.72rem; font-weight: 800; letter-spacing: 0.12em;
            text-transform: uppercase; display: block; margin-bottom: 0.15rem;
        }
        .cli-value {
            font-size: 0.875rem; color: var(--text-mid); font-weight: 500;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .cli-arrow {
            width: 20px; height: 20px; color: var(--text-light); flex-shrink: 0;
            transition: transform 0.2s, color 0.2s;
        }
        .contact-link-item:hover .cli-arrow { transform: translateX(3px); }

        /* ─── FOOTER ────────────────────────────────────────── */
        footer { background:var(--dark); padding:4rem 6rem 0; display:grid; grid-template-columns:1.6fr 1fr 1fr 1fr; gap:3rem; }
        .footer-brand { display:flex; flex-direction:column; gap:1rem; }
        .footer-logo { display:flex; align-items:center; gap:0.75rem; text-decoration:none; }
        .footer-logo img { width:40px; height:40px; object-fit:contain; }
        .footer-logo .nav-name .line1 { color:var(--purple-light); }
        .footer-logo .nav-name .line2 { color:var(--orange-light); }
        .footer-tagline { font-size:0.84rem; color:rgba(255,255,255,0.32); line-height:1.75; }
        .footer-accred-row { display:flex; flex-wrap:wrap; gap:0.4rem; margin-top:0.25rem; }
        .f-tag { font-size:0.63rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; padding:0.22rem 0.6rem; border-radius:3px; border:1px solid; }
        .f-tag.da    { border-color:rgba(212,176,74,0.3); color:var(--gold-light); }
        .f-tag.ati   { border-color:rgba(128,85,196,0.3); color:var(--purple-light); }
        .f-tag.rcef  { border-color:rgba(68,160,80,0.3);  color:var(--green-light); }
        .f-tag.lsa   { border-color:rgba(229,134,74,0.3); color:var(--orange-light); }
        .f-tag.tesda { border-color:rgba(26,138,200,0.3); color:#6abde8; }
        .footer-col h4 { font-size:0.67rem; font-weight:700; letter-spacing:0.22em; text-transform:uppercase; color:rgba(255,255,255,0.3); margin-bottom:1.25rem; }
        .footer-col ul { list-style:none; }
        .footer-col ul li { margin-bottom:0.6rem; }
        .footer-col ul li a { font-size:0.875rem; color:rgba(255,255,255,0.45); text-decoration:none; transition:color 0.2s; display:flex; align-items:flex-start; gap:0.5rem; }
        .footer-col ul li a:hover { color:rgba(255,255,255,0.82); }
        .footer-col ul li a svg { width:14px; height:14px; flex-shrink:0; margin-top:3px; opacity:0.45; }
        .footer-bottom { grid-column:1/-1; padding:2rem 0; margin-top:2rem; border-top:1px solid rgba(255,255,255,0.07); display:flex; justify-content:space-between; align-items:center; }
        .footer-copy { font-size:0.78rem; color:rgba(255,255,255,0.2); }
        .ico { width:16px; height:16px; display:inline-block; vertical-align:middle; }
        .ico-sm { width:14px; height:14px; }

        /* ─── RESPONSIVE ────────────────────────────────────── */
        @media (max-width:1200px) {
            .swaib-result-cards { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width:1024px) {
            .swaib-intro { grid-template-columns:1fr; gap:2.5rem; }
            footer { grid-template-columns:1fr 1fr; }
            .accred-grid { grid-template-columns:1fr; }
            .accred-card.tesda { grid-column:1; }
            .breeds-grid { grid-template-columns:1fr; }
            .breed-panel.gp1040::after { display:none; }
        }
        @media (max-width:768px) {
            nav { padding:0 1.5rem; }
            .nav-links { display:none; flex-direction:column; position:absolute; top:var(--nav-h); left:0; right:0; background:var(--white); padding:1rem 1.5rem; border-bottom:1px solid rgba(92,52,148,0.1); box-shadow:0 8px 24px rgba(0,0,0,0.08); z-index:99; }
            .nav-links.open { display:flex; }
            .nav-toggle { display:flex; }
            .hero { grid-template-columns:1fr; }
            .hero-right { order:-1; padding:3.5rem 2rem 1rem; }
            .hero-img-wrap { max-width:220px; margin:0 auto; }
            .hero-left { padding:1.5rem 2rem 4rem; }
            .hero-desc { max-width:100%; }
            .accreditation { padding:4rem 2rem; }
            .accred-grid { grid-template-columns:1fr; gap:1.25rem; }
            .accred-card { flex-direction:column; }
            .accred-logo-box { width:72px; height:72px; }
            .accred-since { gap:2rem; }
            .about { grid-template-columns:1fr; }
            .about-content { padding:3rem 2rem; }
            .swaib-section { padding:4rem 2rem; }
            .swaib-intro { grid-template-columns:1fr; gap:2rem; }
            .swaib-result-cards { grid-template-columns: 1fr 1fr; }
            .vision-mission { padding:4rem 2rem; }
            .vm-grid { grid-template-columns:1fr; }
            .feedback-section { padding:4rem 2rem; }
            .cta-banner { padding:3.5rem 2rem; flex-direction:column; text-align:center; }
            footer { padding:3rem 2rem 0; grid-template-columns:1fr; }
            .accred-since { padding-top:2rem; margin-top:2.5rem; }
            .breeds-header-area { padding:4rem 2rem 2rem; }
            .breed-panel-content { flex-direction:column; }
            .breed-info { width:100%; padding:2rem; }
            .breed-image-col { width:100%; height:200px; }
            .breeds-bottom-bar { padding:2rem; gap:1.5rem; }
            .contact-modal { margin: 1rem; }
        }
        @media (max-width:480px) {
            .hero-title { font-size:2rem; }
            .accred-card { padding:1.5rem; }
            .swaib-result-cards { grid-template-columns: 1fr; }
            .vm-card { padding:2rem; }
        }
    </style>
</head>
<body>

<div id="scroll-progress"></div>

<!-- ═══ CONTACT MODAL ════════════════════════════════════════ -->
<div class="contact-modal-overlay" id="contactModal" role="dialog" aria-modal="true" aria-label="Contact Us">
    <div class="contact-modal">
        <button class="contact-modal-close" id="contactModalClose" aria-label="Close">
            <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><line x1="2" y1="2" x2="12" y2="12"/><line x1="12" y1="2" x2="2" y2="12"/></svg>
        </button>
        <p class="contact-modal-eyebrow">Get in Touch</p>
        <h2 class="contact-modal-title">Contact Us</h2>
        <p class="contact-modal-subtitle">Reach out through any of the channels below — we're happy to hear from you.</p>
        <div class="contact-links">
            <!-- Facebook -->
            <a href="https://www.facebook.com/profile.php?id=100075980057886" target="_blank" rel="noopener" class="contact-link-item fb">
                <div class="cli-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 2H15C13.67 2 12 3.67 12 5V8H9V12H12V22H16V12H19L20 8H16V5C16 4.45 16.45 4 17 4H20V2H18Z"/></svg>
                </div>
                <div class="cli-text">
                    <span class="cli-label">Facebook</span>
                    <span class="cli-value">Mercedes Science Farm</span>
                </div>
                <svg class="cli-arrow" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 8H13M9 4L13 8L9 12" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            <!-- Location -->
            <a href="https://maps.google.com/?q=Zone+6+TARUM+Libmanan+Camarines+Sur+Philippines+4407" target="_blank" rel="noopener" class="contact-link-item loc">
                <div class="cli-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9C5 14.25 12 22 12 22C12 22 19 14.25 19 9C19 5.13 15.87 2 12 2ZM12 11.5C10.62 11.5 9.5 10.38 9.5 9C9.5 7.62 10.62 6.5 12 6.5C13.38 6.5 14.5 7.62 14.5 9C14.5 10.38 13.38 11.5 12 11.5Z"/></svg>
                </div>
                <div class="cli-text">
                    <span class="cli-label">Location</span>
                    <span class="cli-value">Zone 6 Tarum, Libmanan, ....</span>
                </div>
                <svg class="cli-arrow" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 8H13M9 4L13 8L9 12" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            <!-- Gmail -->
            <a href="mailto:mercedessciencefarm2021@gmail.com?subject=Inquiry%20-%20Mercedes%20Science%20Farm" class="contact-link-item gm">
                <div class="cli-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM20 8L12 13L4 8V6L12 11L20 6V8Z"/></svg>
                </div>
                <div class="cli-text">
                    <span class="cli-label">Email / Gmail</span>
                    <span class="cli-value">mercedessciencefarm2021@gmail...</span>
                </div>
                <svg class="cli-arrow" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 8H13M9 4L13 8L9 12" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
            <!-- Phone -->
            <a href="tel:09913870423" class="contact-link-item ph">
                <div class="cli-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M6.6 10.8C7.8 13.2 9.8 15.2 12.2 16.4L14.2 14.4C14.46 14.14 14.84 14.06 15.16 14.18C16.24 14.56 17.42 14.76 18.6 14.76C19.38 14.76 20 15.38 20 16.16V19.6C20 20.38 19.38 21 18.6 21C9.98 21 3 14.02 3 5.4C3 4.62 3.62 4 4.4 4H7.86C8.64 4 9.26 4.62 9.26 5.4C9.26 6.58 9.46 7.74 9.84 8.84C9.96 9.16 9.88 9.54 9.6 9.8L7.6 11.8L6.6 10.8Z"/></svg>
                </div>
                <div class="cli-text">
                    <span class="cli-label">Phone</span>
                    <span class="cli-value">0991 387 0423</span>
                </div>
                <svg class="cli-arrow" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 8H13M9 4L13 8L9 12" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </div>
    </div>
</div>

<!-- ═══ NAVIGATION ════════════════════════════════════════════ -->
<nav id="mainNav">
    <a href="{{ url('/') }}" class="nav-brand">
        <img src="{{ asset('images/LOGO.png') }}" alt="MSF Logo" class="nav-logo-img">
        <span class="nav-name">
            <span class="line1">Mercedes</span>
            <span class="line2">Science Farm</span>
        </span>
    </a>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>
    <ul class="nav-links" id="navLinks">
        <li><a href="#accreditation">Accreditation</a></li>
        <li><a href="#our-beginnings">Our Beginnings</a></li>
        <li><a href="#programs">What We Offer</a></li>
        <li><a href="#vision-mission">Vision &amp; Mission</a></li>
        <li><a href="#feedback">Community Voices</a></li>
    </ul>
</nav>

<!-- ═══ HERO ══════════════════════════════════════════════════ -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grain"></div>
    <div class="hero-right reveal-right">
        <div class="hero-img-wrap">
            <div class="hero-img-ring"></div>
            <div class="hero-img-ring-2"></div>
            <img src="{{ asset('images/LOGO.png') }}" alt="Mercedes Science Farm logo">
        </div>
    </div>
    <div class="hero-left reveal-left">
        <span class="hero-badge">
            <svg viewBox="0 0 16 16" fill="none" class="ico-sm"><path d="M8 2C6.34 2 5 3.34 5 5C5 6.24 5.67 7.32 6.68 7.87L6.5 9H9.5L9.32 7.87C10.33 7.32 11 6.24 11 5C11 3.34 9.66 2 8 2Z" stroke="currentColor" stroke-width="1.2" fill="none"/><path d="M6.5 9V11.5H9.5V9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/><path d="M7 13H9" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
            Science · Farm · Nature
        </span>
        <p class="hero-since">Established 2021</p>
        <h1 class="hero-title">
            Where <span class="ap">Science</span><br>
            Meets the <span class="ag">Farm</span>
        </h1>
        <p class="hero-desc">
            Mercedes Science Farm is a Department of Agriculture–accredited agricultural establishment in Libmanan, Camarines Sur, combining scientific research with sustainable farming practices to serve and empower the local community.
        </p>
    </div>
</section>

<!-- ═══ ACCREDITATION ════════════════════════════════════════ -->
<section class="accreditation" id="accreditation">
    <div class="accred-orb accred-orb-1"></div>
    <div class="accred-orb accred-orb-2"></div>
    <div class="accred-orb accred-orb-3"></div>
    <div class="accred-inner">
        <div class="accred-header reveal">
            <span class="eyebrow gold center">Official Recognition</span>
            <h2 class="section-title" style="color:var(--white);">We Are Proudly Accredited By</h2>
        </div>
        <p class="accred-lead reveal">
            Mercedes Science Farm carries formal accreditation from the Philippine Department of Agriculture and its affiliated agencies — a testament to our commitment to excellence in agricultural practice and education.
        </p>
        <div class="accred-grid">
            <div class="accred-card da reveal" style="transition-delay:0.05s">
                <div class="accred-logo-box">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="46" fill="#1a3a1a" stroke="#d4b04a" stroke-width="2"/><circle cx="50" cy="50" r="38" fill="none" stroke="#d4b04a" stroke-width="1" stroke-dasharray="3,3"/><g stroke="#f0d070" stroke-width="1.5" stroke-linecap="round"><line x1="50" y1="8" x2="50" y2="14"/><line x1="72" y1="14" x2="68" y2="19"/><line x1="86" y1="35" x2="81" y2="37"/><line x1="92" y1="50" x2="86" y2="50"/><line x1="86" y1="65" x2="81" y2="63"/><line x1="72" y1="86" x2="68" y2="81"/><line x1="50" y1="92" x2="50" y2="86"/><line x1="28" y1="86" x2="32" y2="81"/><line x1="14" y1="65" x2="19" y2="63"/><line x1="8" y1="50" x2="14" y2="50"/><line x1="14" y1="35" x2="19" y2="37"/><line x1="28" y1="14" x2="32" y2="19"/></g><path d="M34 72 Q30 60 32 45" stroke="#8dc97e" stroke-width="2" fill="none" stroke-linecap="round"/><ellipse cx="31" cy="58" rx="4" ry="7" fill="#5a9e4a" transform="rotate(-20 31 58)"/><ellipse cx="33" cy="50" rx="4" ry="7" fill="#6aae58" transform="rotate(-15 33 50)"/><path d="M66 72 Q70 60 68 45" stroke="#8dc97e" stroke-width="2" fill="none" stroke-linecap="round"/><ellipse cx="69" cy="58" rx="4" ry="7" fill="#5a9e4a" transform="rotate(20 69 58)"/><ellipse cx="67" cy="50" rx="4" ry="7" fill="#6aae58" transform="rotate(15 67 50)"/><circle cx="50" cy="38" r="10" fill="#f0c030" opacity="0.9"/><circle cx="50" cy="38" r="7" fill="#fada50"/><path d="M22 72 L38 50 L50 62 L62 46 L78 72Z" fill="#2d6e28" opacity="0.8"/><path d="M22 72 Q50 68 78 72 L78 80 Q50 76 22 80Z" fill="#1a5fa0" opacity="0.7"/><text x="50" y="88" text-anchor="middle" font-family="serif" font-size="5.5" font-weight="bold" fill="#d4b04a" letter-spacing="0.5">KAGAWARAN NG PAGSASAKA</text></svg>
                </div>
                <div class="accred-card-text">
                    <p class="accred-acronym">DA</p>
                    <p class="accred-fullname">Department of Agriculture</p>
                    <p class="accred-desc">The primary government agency responsible for the promotion of agricultural development and growth in the Philippines. Our accreditation by the DA confirms our farm's compliance with national agricultural standards.</p>
                    <span class="accred-tag">Government Accredited</span>
                </div>
            </div>
            <div class="accred-card ati reveal" style="transition-delay:0.15s">
                <div class="accred-logo-box">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="46" fill="#1e1040" stroke="#7248b8" stroke-width="2"/><rect x="25" y="52" width="50" height="28" rx="3" fill="#3a2080" stroke="#7248b8" stroke-width="1"/><path d="M50 55 Q40 50 28 54 L28 75 Q40 71 50 76Z" fill="#4a30a0" stroke="#9a72d4" stroke-width="0.8"/><path d="M50 55 Q60 50 72 54 L72 75 Q60 71 50 76Z" fill="#5238b0" stroke="#9a72d4" stroke-width="0.8"/><line x1="50" y1="55" x2="50" y2="76" stroke="#9a72d4" stroke-width="1.5"/><path d="M50 20 Q55 26 52 32 Q58 26 56 20 Q60 27 57 34 Q62 28 59 22 Q64 32 58 40 Q54 44 50 48 Q46 44 42 40 Q36 32 41 22 Q38 28 43 34 Q40 26 44 20 Q42 26 48 32 Q45 26 50 20Z" fill="#f0a030" opacity="0.9"/><path d="M50 28 Q53 32 51 36 Q54 32 53 28 Q56 33 54 38 Q52 42 50 44 Q48 42 46 38 Q44 33 47 28 Q47 32 49 36 Q48 32 50 28Z" fill="#ffd060"/><g stroke="#d4a040" stroke-width="1" opacity="0.6" stroke-linecap="round"><line x1="50" y1="15" x2="50" y2="10"/><line x1="60" y1="20" x2="64" y2="16"/><line x1="40" y1="20" x2="36" y2="16"/><line x1="65" y1="32" x2="70" y2="30"/><line x1="35" y1="32" x2="30" y2="30"/></g><text x="50" y="90" text-anchor="middle" font-family="sans-serif" font-size="7" font-weight="bold" fill="#9a72d4" letter-spacing="1">ATI</text></svg>
                </div>
                <div class="accred-card-text">
                    <p class="accred-acronym">ATI</p>
                    <p class="accred-fullname">Agricultural Training Institute</p>
                    <p class="accred-desc">The extension and training arm of the Department of Agriculture, mandated to enhance capabilities through education and knowledge-sharing. ATI recognition certifies our role as a legitimate agricultural learning hub.</p>
                    <span class="accred-tag">Extension Arm of DA</span>
                </div>
            </div>
            <div class="accred-card rcef reveal" style="transition-delay:0.25s">
                <div class="accred-logo-box">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="46" fill="#0e2a12" stroke="#286e30" stroke-width="2"/><path d="M15 75 Q25 65 35 70 Q45 75 50 65 Q55 55 65 60 Q75 65 85 55" stroke="#44a050" stroke-width="2" fill="none" stroke-linecap="round" opacity="0.7"/><g stroke="#68c06a" stroke-width="1.5" fill="none"><line x1="30" y1="72" x2="28" y2="52"/><line x1="40" y1="70" x2="38" y2="50"/><line x1="50" y1="68" x2="50" y2="48"/><line x1="60" y1="66" x2="62" y2="46"/><line x1="70" y1="64" x2="72" y2="44"/></g><g fill="#c8e890"><ellipse cx="28" cy="52" rx="4" ry="6" transform="rotate(-10 28 52)"/><ellipse cx="38" cy="50" rx="4" ry="6" transform="rotate(-5 38 50)"/><ellipse cx="50" cy="48" rx="4" ry="6"/><ellipse cx="62" cy="46" rx="4" ry="6" transform="rotate(5 62 46)"/><ellipse cx="72" cy="44" rx="4" ry="6" transform="rotate(10 72 44)"/></g><circle cx="50" cy="28" r="14" fill="#1a4a1e" stroke="#44a050" stroke-width="1.5"/><text x="50" y="25" text-anchor="middle" font-family="sans-serif" font-size="6" font-weight="bold" fill="#c8e890">RA</text><text x="50" y="33" text-anchor="middle" font-family="sans-serif" font-size="6.5" font-weight="bold" fill="#80d090">11203</text><text x="50" y="92" text-anchor="middle" font-family="sans-serif" font-size="5.5" font-weight="bold" fill="#44a050" letter-spacing="0.5">RCEF FARM SCHOOL</text></svg>
                </div>
                <div class="accred-card-text">
                    <p class="accred-acronym">RCEF</p>
                    <p class="accred-fullname">Rice Competitiveness Enhancement Fund</p>
                    <p class="accred-desc">Established under Republic Act 11203, the Rice Tariffication Law, RCEF supports rice farmers' competitiveness and income. Our accreditation identifies us as a certified RCEF Farm School contributing to rice extension services nationwide.</p>
                    <span class="accred-tag">RCEF Farm School</span>
                </div>
            </div>
            <div class="accred-card lsa reveal" style="transition-delay:0.35s">
                <div class="accred-logo-box">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="46" fill="#2a1208" stroke="#c95e0c" stroke-width="2"/><path d="M20 38 Q20 32 26 32 Q38 30 50 36 L50 72 Q38 66 26 68 Q20 68 20 62Z" fill="#4a2008" stroke="#c95e0c" stroke-width="1.2"/><path d="M80 38 Q80 32 74 32 Q62 30 50 36 L50 72 Q62 66 74 68 Q80 68 80 62Z" fill="#5a2810" stroke="#c95e0c" stroke-width="1.2"/><g stroke="#e0803a" stroke-width="0.8" opacity="0.7" stroke-linecap="round"><line x1="28" y1="42" x2="46" y2="41"/><line x1="28" y1="47" x2="46" y2="46"/><line x1="28" y1="52" x2="46" y2="51"/><line x1="28" y1="57" x2="46" y2="56"/><line x1="28" y1="62" x2="46" y2="61"/></g><g stroke="#e0803a" stroke-width="0.8" opacity="0.7" stroke-linecap="round"><line x1="54" y1="41" x2="72" y2="42"/><line x1="54" y1="46" x2="72" y2="47"/><line x1="54" y1="51" x2="72" y2="52"/><line x1="54" y1="56" x2="72" y2="57"/><line x1="54" y1="61" x2="72" y2="62"/></g><path d="M50 36 L50 22" stroke="#68c060" stroke-width="2" stroke-linecap="round"/><path d="M50 28 Q44 22 40 24" stroke="#68c060" stroke-width="1.5" fill="none" stroke-linecap="round"/><ellipse cx="42" cy="24" rx="6" ry="4" fill="#4aaa40" transform="rotate(-20 42 24)"/><path d="M50 24 Q56 18 60 20" stroke="#68c060" stroke-width="1.5" fill="none" stroke-linecap="round"/><ellipse cx="58" cy="20" rx="6" ry="4" fill="#5aba50" transform="rotate(20 58 20)"/><rect x="42" y="13" width="16" height="3" rx="1" fill="#c95e0c"/><polygon points="50,10 43,13 57,13" fill="#e07030"/><circle cx="50" cy="10" r="2" fill="#ffa060"/><text x="50" y="90" text-anchor="middle" font-family="sans-serif" font-size="5.5" font-weight="bold" fill="#c95e0c" letter-spacing="0.3">LEARNING SITE FOR AGRI</text></svg>
                </div>
                <div class="accred-card-text">
                    <p class="accred-acronym">LSA</p>
                    <p class="accred-fullname">Learning Site for Agriculture</p>
                    <p class="accred-desc">A designation granted by the Department of Agriculture to farms that serve as functional demonstration and training venues. As an LSA, Mercedes Science Farm is a recognized site for practical agricultural education and skills development.</p>
                    <span class="accred-tag">Demonstration Site</span>
                </div>
            </div>
            <div class="accred-card tesda reveal" style="transition-delay:0.45s">
                <div class="accred-logo-box">
                    <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="46" fill="#061828" stroke="#1a8ac8" stroke-width="2"/><circle cx="50" cy="50" r="38" fill="none" stroke="#1a8ac8" stroke-width="0.8" stroke-dasharray="4,3"/><circle cx="50" cy="50" r="14" fill="#0a3a5c" stroke="#1a8ac8" stroke-width="1.5"/><circle cx="50" cy="50" r="7" fill="#1a5c8a"/><g fill="#1a8ac8"><rect x="47" y="28" width="6" height="8" rx="2"/><rect x="47" y="64" width="6" height="8" rx="2"/><rect x="28" y="47" width="8" height="6" rx="2"/><rect x="64" y="47" width="8" height="6" rx="2"/><rect x="34" y="34" width="6" height="8" rx="2" transform="rotate(45 37 38)"/><rect x="60" y="58" width="6" height="8" rx="2" transform="rotate(45 63 62)"/><rect x="58" y="34" width="6" height="8" rx="2" transform="rotate(-45 61 38)"/><rect x="34" y="58" width="6" height="8" rx="2" transform="rotate(-45 37 62)"/></g><g fill="#f0c030"><polygon points="50,15 51.5,19 55.5,19 52.3,21.5 53.5,25.5 50,23 46.5,25.5 47.7,21.5 44.5,19 48.5,19" transform="scale(0.75) translate(16.7,4)"/><polygon points="20,50 21.5,54 25.5,54 22.3,56.5 23.5,60.5 20,58 16.5,60.5 17.7,56.5 14.5,54 18.5,54" transform="scale(0.75) translate(6.7,-17.3)"/><polygon points="80,50 81.5,54 85.5,54 82.3,56.5 83.5,60.5 80,58 76.5,60.5 77.7,56.5 74.5,54 78.5,54" transform="scale(0.75) translate(-13.3,-17.3)"/></g><text x="50" y="90" text-anchor="middle" font-family="sans-serif" font-size="7" font-weight="bold" fill="#6abde8" letter-spacing="1">TESDA</text></svg>
                </div>
                <div class="accred-card-text">
                    <p class="accred-acronym">TESDA</p>
                    <p class="accred-fullname">Technical Education and Skills Development Authority</p>
                    <p class="accred-desc">The government agency responsible for technical-vocational education and training (TVET) in the Philippines. Our partnership with TESDA recognizes Mercedes Science Farm as an accredited training center, enabling us to provide nationally certified skills programs in agriculture and related fields.</p>
                    <span class="accred-tag">TVET Partner</span>
                </div>
            </div>
        </div>
        <div class="accred-since reveal" id="statsArea">
            <div class="since-item">
                <span class="since-number" id="statYear">2025<span>.</span></span>
                <span class="since-label">Year Established</span>
            </div>
            <div class="since-item">
                <span class="since-number"><span id="statAccred">0</span><span>+</span></span>
                <span class="since-label">Accreditations &amp; Partnerships</span>
            </div>
            <div class="since-item">
                <span class="since-number"><span id="statYear2">1</span><span id="statOrdinal" class="since-ordinal">st</span></span>
                <span class="since-label">Year of Operation</span>
            </div>
        </div>
    </div>
</section>

<!-- ═══ ABOUT / OUR BEGINNINGS ════════════════════════════════ -->
<section class="about" id="our-beginnings">
    <div class="about-img reveal-left" id="aboutImgSection">
        <img src="{{ asset('images/POSTER.png') }}" alt="About Mercedes Science Farm">
        <div class="about-img-anim" id="aboutAnim">
            <div class="anim-corner tl"></div>
            <div class="anim-corner br"></div>
            <div class="anim-scanline"></div>
        </div>
        <div class="about-img-badge">
            <span class="about-img-badge-pill">Est. 2021</span>
            <span class="about-img-badge-pill">Libmanan, CamSur</span>
            <span class="about-img-badge-pill">DA Accredited</span>
        </div>
    </div>
    <div class="about-content reveal-right">
        <span class="eyebrow purple">About the Farm</span>
        <h2 class="section-title">A Farm Built on<br>Science &amp; Passion</h2>
        <p class="section-body">
            Mercedes Science Farm is a pioneering agricultural facility established in 2021 in Zone 6 Tarum, Libmanan, Camarines Sur. Formally recognized and accredited by the Department of Agriculture through its ATI, RCEF, and LSA programs — and proudly partnered with TESDA — we bridge modern scientific methods with practical farming to produce sustainable, high-quality yields and serve the community.
        </p>
        <div class="partner-row">
            <span class="partner-badge da"><svg viewBox="0 0 10 10" width="10" height="10"><circle cx="5" cy="5" r="4" fill="currentColor" opacity="0.4"/></svg>DA</span>
            <span class="partner-badge ati"><svg viewBox="0 0 10 10" width="10" height="10"><circle cx="5" cy="5" r="4" fill="currentColor" opacity="0.4"/></svg>ATI</span>
            <span class="partner-badge rcef"><svg viewBox="0 0 10 10" width="10" height="10"><circle cx="5" cy="5" r="4" fill="currentColor" opacity="0.4"/></svg>RCEF</span>
            <span class="partner-badge lsa"><svg viewBox="0 0 10 10" width="10" height="10"><circle cx="5" cy="5" r="4" fill="currentColor" opacity="0.4"/></svg>LSA</span>
            <span class="partner-badge tesda"><svg viewBox="0 0 10 10" width="10" height="10"><circle cx="5" cy="5" r="4" fill="currentColor" opacity="0.4"/></svg>TESDA</span>
        </div>
        <a href="{{ url('/about') }}" style="align-self:flex-start;margin-top:1.75rem;display:inline-flex;align-items:center;gap:0.5rem;padding:0.8rem 1.875rem;background:var(--purple);color:var(--white);font-family:'DM Sans',sans-serif;font-size:0.875rem;font-weight:600;border-radius:4px;text-decoration:none;letter-spacing:0.02em;transition:background 0.22s,transform 0.22s,box-shadow 0.22s;box-shadow:0 4px 18px rgba(92,52,148,0.28);" onmouseover="this.style.background='#7248b8';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#5c3494';this.style.transform=''">
            <svg viewBox="0 0 16 16" fill="none" class="ico-sm"><path d="M3 8H13M9 4L13 8L9 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Read Our Story
        </a>
    </div>
</section>

<!-- ═══ WHAT WE OFFER — SWAIB ════════════════════════════════ -->
<section class="swaib-section" id="programs">
    <div class="swaib-intro">
        <div class="swaib-intro-text reveal-left">
            <span class="eyebrow pink">What We Offer</span>
            <h2 class="swaib-name"><span class="accent">SWAIB</span><br>Program</h2>
            <div class="swaib-acronym-row">
                <span class="swaib-acronym-pill">SWAIB</span>
                <span class="swaib-tagline">Swine Artificial Insemination sa Barangay</span>
            </div>
            <p class="swaib-intro-body">
                Mercedes Science Farm's flagship program brings cutting-edge reproductive science directly to the barangay level. Through <strong>Swine Artificial Insemination sa Barangay (SWAIB)</strong>, we help local hog raisers improve the genetic quality of their pigs — producing offspring that are healthier, grow faster, and yield more meat — without the cost and risk of traditional boar stocking.
            </p>
            <p class="swaib-intro-body" style="margin-top:1rem;">
                Our trained technicians work farm-to-farm, bringing high-quality semen from superior boar genetics directly to smallholder farmers across Libmanan and surrounding barangays.
            </p>
            <div class="swaib-stats">
                <div class="swaib-stat"><span class="swaib-stat-num">AI</span><span class="swaib-stat-label">Technology Used</span></div>
                <div class="swaib-stat"><span class="swaib-stat-num">Barangay</span><span class="swaib-stat-label">Level Reach</span></div>
                <div class="swaib-stat"><span class="swaib-stat-num">↑ Genetics</span><span class="swaib-stat-label">Improved Bloodlines</span></div>
            </div>
        </div>
        <div class="swaib-highlight-card reveal-right">
            <h4>Why SWAIB Changes Lives</h4>
            <ul class="swaib-benefit-list">
                <li><div class="swaib-benefit-icon"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span>Superior boar genetics without needing to own a boar — reducing costs and disease risk for smallholder farmers.</span></li>
                <li><div class="swaib-benefit-icon"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span>Faster-growing piglets with better feed conversion ratios, directly increasing farm profitability.</span></li>
                <li><div class="swaib-benefit-icon"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span>Service delivered at the barangay level — accessible to even the most remote hog raisers in the community.</span></li>
                <li><div class="swaib-benefit-icon"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span>Hands-on farmer training included — empowering local raisers with the knowledge to sustain genetic improvement long-term.</span></li>
                <li><div class="swaib-benefit-icon"><svg viewBox="0 0 12 12" fill="none"><path d="M2 6L5 9L10 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></div><span>Supports the DA's mandate of improving livestock productivity and food security at the grassroots level.</span></li>
            </ul>
        </div>
    </div>

    <!-- ── SWAIB RESULT CARDS (replaces old gallery) ─────── -->
    <div class="swaib-results reveal">
        <div class="swaib-results-heading">
            <h3>Program Results &amp; Impact</h3>
            <p>What SWAIB delivers to every farmer who partners with us</p>
        </div>
        <div class="swaib-result-cards">
            <div class="swaib-result-card reveal" style="transition-delay:0.05s">
                <div class="src-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 17l4-4 4 4 4-6 4 4" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="5" r="3"/></svg>
                </div>
                <div class="src-stat">↑ 30%</div>
                <div class="src-title">More Productive</div>
                <p class="src-desc">AI-bred sows consistently produce larger, healthier litters compared to natural mating with local boars.</p>
            </div>
            <div class="swaib-result-card reveal" style="transition-delay:0.12s">
                <div class="src-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 3C8.13 3 5 6.13 5 10c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38v-1.33c-2.24.48-2.71-1.07-2.71-1.07-.37-.93-.9-1.18-.9-1.18-.73-.5.06-.49.06-.49.81.06 1.23.83 1.23.83.72 1.23 1.88.87 2.34.67.07-.52.28-.87.51-1.07-1.78-.2-3.65-.89-3.65-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82A7.66 7.66 0 0112 7.13c.68 0 1.36.09 2 .27 1.52-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48v2.2c0 .21.15.46.55.38A8.01 8.01 0 0019 10c0-3.87-3.13-7-7-7z" fill="currentColor" stroke="none"/></svg>
                </div>
                <div class="src-stat">PIC®</div>
                <div class="src-title">Results You Can See</div>
                <p class="src-desc">Visibly superior offspring — better conformation, faster growth, and higher carcass value at market.</p>
            </div>
            <div class="swaib-result-card reveal" style="transition-delay:0.2s">
                <div class="src-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="src-stat">Zero</div>
                <div class="src-title">Boar Risk</div>
                <p class="src-desc">No boar to feed, house, or manage. Eliminate disease transmission risk while accessing world-class genetics.</p>
            </div>
            <div class="swaib-result-card reveal" style="transition-delay:0.28s">
                <div class="src-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="src-stat">Supportive</div>
                <div class="src-title">Service</div>
                <p class="src-desc">We Remain Active on our platforms to answer our client's concerns</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══ AVAILABLE BREEDS (moved here, under What We Offer) ═══ -->
<section class="breeds-section" id="breeds">
    <div class="breeds-header-area reveal">
        <span class="eyebrow green center">PIC Genetics</span>
        <h2 class="section-title">Available Breeds</h2>
        <p class="breeds-subtitle">World-class swine genetics brought to the barangay level</p>
    </div>
    <div class="breeds-grid">
        <!-- GP 1040 -->
        <div class="breed-panel gp1040">
            <div class="breed-panel-bg"></div>
            <div class="breed-hover-glow"></div>
            <div class="breed-panel-content">
                <div class="breed-info">
                    <div class="breed-pic-logo">
                        <span class="breed-pic-text" style="color:#c8f060;">PIC<sup class="breed-pic-reg">®</sup></span>
                    </div>
                    <div class="breed-model-name">GP 1040</div>
                    <ul class="breed-features">
                        <li class="breed-feature-item">
                            <div class="breed-feature-icon">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M2 10l3-3 3 3 3-5 3 3"/></svg>
                            </div>
                            <div class="breed-feature-text">
                                <span class="breed-feature-title">Lower Feed Cost</span>
                                <span class="breed-feature-desc">Optimized feed conversion ratio for maximum efficiency</span>
                            </div>
                        </li>
                        <li class="breed-feature-item">
                            <div class="breed-feature-icon">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><circle cx="8" cy="8" r="5.5"/><path d="M8 5v3l2 2"/></svg>
                            </div>
                            <div class="breed-feature-text">
                                <span class="breed-feature-title">High-Performing Progeny</span>
                                <span class="breed-feature-desc">Consistent contribution to superior offspring performance</span>
                            </div>
                        </li>
                        <li class="breed-feature-item">
                            <div class="breed-feature-icon">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M8 2C5.24 2 3 4.24 3 7c0 1.85 1 3.47 2.5 4.33L5 14h6l-.5-2.67A5 5 0 0013 7c0-2.76-2.24-5-5-5z"/></svg>
                            </div>
                            <div class="breed-feature-text">
                                <span class="breed-feature-title">Strong Mothering Ability</span>
                                <span class="breed-feature-desc">Exceptional maternal traits for larger, healthier litters</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="breed-image-col">
                    <img src="{{ asset('images/PIC GP 1040.png') }}" alt="PIC GP 1040 swine breed">
                </div>
            </div>
        </div>
        <!-- PIC 410 -->
        <div class="breed-panel pic410">
            <div class="breed-panel-bg"></div>
            <div class="breed-hover-glow"></div>
            <div class="breed-panel-content">
                <div class="breed-info">
                    <div class="breed-pic-logo">
                        <span class="breed-pic-text" style="color:#f0c840;">PIC</span>
                    </div>
                    <div class="breed-model-name">410</div>
                    <ul class="breed-features">
                        <li class="breed-feature-item">
                            <div class="breed-feature-icon">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><rect x="2" y="10" width="3" height="4"/><rect x="6.5" y="7" width="3" height="7"/><rect x="11" y="4" width="3" height="10"/></svg>
                            </div>
                            <div class="breed-feature-text">
                                <span class="breed-feature-title">Efficient Growth &amp; Conformation</span>
                                <span class="breed-feature-desc">Superior body structure with optimal muscle development</span>
                            </div>
                        </li>
                        <li class="breed-feature-item">
                            <div class="breed-feature-icon">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M2 12l4-4 3 2 5-7"/></svg>
                            </div>
                            <div class="breed-feature-text">
                                <span class="breed-feature-title">Fast Growth to Heavier Weights</span>
                                <span class="breed-feature-desc">Reaches market weight faster, increasing farm turnover</span>
                            </div>
                        </li>
                        <li class="breed-feature-item">
                            <div class="breed-feature-icon">
                                <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M8 2l1.5 3 3.5.5-2.5 2.5.5 3.5L8 10l-3 1.5.5-3.5L3 5.5 6.5 5z"/></svg>
                            </div>
                            <div class="breed-feature-text">
                                <span class="breed-feature-title">Exceptional Primal Yield</span>
                                <span class="breed-feature-desc">High carcass value maximizes profitability per animal</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="breed-image-col">
                    <img src="{{ asset('images/PIC410.png') }}" alt="PIC 410 swine breed">
                </div>
            </div>
        </div>
    </div>
    <div class="breeds-bottom-bar">
        <span class="breeds-bottom-tag">PIC Certified Genetics</span>
        <span class="breeds-bottom-tag">AI Service Available</span>
        <span class="breeds-bottom-tag">Barangay-Level Delivery</span>
        <span class="breeds-bottom-tag">DA Accredited Farm</span>
    </div>
</section>

<!-- ═══ VISION & MISSION ══════════════════════════════════════ -->
<section class="vision-mission" id="vision-mission">
    <div class="vm-header reveal">
        <span class="eyebrow gold center">Our Direction</span>
        <h2 class="section-title">Vision &amp; Mission</h2>
    </div>
    <div class="vm-rule reveal">
        <span class="vm-rule-ornament">✦ ✦ ✦</span>
    </div>
    <div class="vm-grid">
        <div class="vm-card vision reveal-left">
            <div class="vm-card-bar"></div>
            <div class="vm-card-icon">
                <svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="var(--vm-gold)" stroke-width="1.5"/><circle cx="12" cy="12" r="3" stroke="var(--vm-gold)" stroke-width="1.5"/><path d="M12 3V6M12 18V21M3 12H6M18 12H21" stroke="var(--vm-gold)" stroke-width="1.5" stroke-linecap="round"/></svg>
            </div>
            <h3 class="vm-card-title">Our Vision</h3>
            <div class="vm-card-divider"></div>
            <p class="vm-vision-quote">
                "To be a leading model of science-based, sustainable agriculture in Camarines Sur — empowering farmers, nurturing the land, and producing quality harvests that nourish communities for generations to come."
            </p>
        </div>
        <div class="vm-card mission reveal-right">
            <div class="vm-card-bar"></div>
            <div class="vm-card-icon">
                <svg viewBox="0 0 24 24" fill="none"><path d="M5 12L9 16L19 6" stroke="var(--vm-gold)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="9" stroke="var(--vm-gold)" stroke-width="1.5"/></svg>
            </div>
            <h3 class="vm-card-title">Our Mission</h3>
            <div class="vm-card-divider"></div>
            <div class="vm-card-body">
                <ul>
                    <li>Integrate scientific research and innovation into everyday farming practices.</li>
                    <li>Promote sustainable, eco-friendly agriculture that protects natural resources.</li>
                    <li>Support the local farming community through education, training, and collaboration.</li>
                    <li>Uphold the standards set by DA-ATI, RCEF, LSA, and TESDA in all operations.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- ═══ COMMUNITY FEEDBACK ════════════════════════════════════ -->
<section class="feedback-section" id="feedback">
    <div class="feedback-header reveal">
        <span class="eyebrow purple center">Community Voices</span>
        <h2 class="section-title" style="text-align:center;">What the Community Says</h2>
        <p style="text-align:center;font-size:0.9rem;color:var(--text-light);max-width:480px;margin:0 auto;">Real reactions from farmers, neighbors, and supporters of Mercedes Science Farm.</p>
    </div>
    <div class="feedback-marquee-wrap reveal">
        <div class="feedback-track" id="feedbackTrack">
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Wow galing nmn ng packaging sana all 🐷✨</p><div class="fb-author"><div class="fb-avatar v1">M</div><div class="fb-author-info"><span class="fb-name">Marife Montales Ariola</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Maraming salamat po Mam and Sir Lorenzo Nuñez and Mercedes Science Agricultural Farm 🙏</p><div class="fb-author"><div class="fb-avatar v2">R</div><div class="fb-author-info"><span class="fb-name">Ray Obsum</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Thank you po 🙏 40 days old na tiyan ni mama pig — proud na proud kami sa resulta!</p><div class="fb-author"><div class="fb-avatar v3">R</div><div class="fb-author-info"><span class="fb-name">Richard Carlo</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Congratulations to all! Keep it up ❤️ So inspiring to see science working for our community!</p><div class="fb-author"><div class="fb-avatar v4">L</div><div class="fb-author-info"><span class="fb-name">Lorily Alarma</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Congrats!!!! Keep it up bro 🔥 Proud of what you're doing for the farmers here!</p><div class="fb-author"><div class="fb-avatar v5">V</div><div class="fb-author-info"><span class="fb-name">Van Muel</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
            <!-- Duplicates for loop -->
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Wow galing nmn ng packaging sana all 🐷✨</p><div class="fb-author"><div class="fb-avatar v1">M</div><div class="fb-author-info"><span class="fb-name">Marife Montales Ariola</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Maraming salamat po Mam and Sir Lorenzo Nuñez and Mercedes Science Agricultural Farm 🙏</p><div class="fb-author"><div class="fb-avatar v2">R</div><div class="fb-author-info"><span class="fb-name">Ray Obsum</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Thank you po 🙏 40 days old na tiyan ni mama pig — proud na proud kami sa resulta!</p><div class="fb-author"><div class="fb-avatar v3">R</div><div class="fb-author-info"><span class="fb-name">Richard Carlo</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Congratulations to all! Keep it up ❤️ So inspiring to see science working for our community!</p><div class="fb-author"><div class="fb-avatar v4">L</div><div class="fb-author-info"><span class="fb-name">Lorily Alarma</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
            <div class="fb-card"><span class="fb-quote-mark">"</span><div class="fb-stars"><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg><svg viewBox="0 0 14 14" fill="#f0c030"><polygon points="7,1 8.5,5 13,5 9.5,7.5 11,12 7,9.5 3,12 4.5,7.5 1,5 5.5,5"/></svg></div><p class="fb-message">Congrats!!!! Keep it up bro 🔥 Proud of what you're doing for the farmers here!</p><div class="fb-author"><div class="fb-avatar v5">V</div><div class="fb-author-info"><span class="fb-name">Van Muel</span><span class="fb-source"><svg viewBox="0 0 14 14" fill="currentColor"><path d="M9.5 2H11V4H9.5C8.67 4 8 4.67 8 5.5V6.5H11L10.5 9H8V13H5.5V9H3.5V6.5H5.5V5.5C5.5 3.57 7.07 2 9 2H9.5Z"/></svg>Facebook Comment</span></div></div></div>
        </div>
    </div>
</section>

<!-- ═══ CTA BANNER ════════════════════════════════════════════ -->
<section class="cta-banner">
    <div class="cta-text reveal-left">
        <h2 class="section-title">Plan Your Visit to<br>Mercedes Science Farm</h2>
        <p class="section-body">We welcome students, researchers, and agricultural enthusiasts. Reach out to schedule a farm visit or inquire about our programs.</p>
    </div>
    <!-- Contact Us now opens modal instead of navigating -->
    <button class="btn-white reveal-right" id="openContactModal" style="position:relative;z-index:1;">
        <svg viewBox="0 0 16 16" fill="none" class="ico-sm"><rect x="2" y="3" width="12" height="9" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M2 4L8 8.5L14 4" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
        Contact Us
    </button>
</section>

<!-- ═══ FOOTER ════════════════════════════════════════════════ -->
<footer>
    <div class="footer-brand">
        <a href="{{ url('/') }}" class="footer-logo">
            <img src="{{ asset('images/LOGO.png') }}" alt="MSF Logo">
            <span class="nav-name"><span class="line1">Mercedes</span><span class="line2">Science Farm</span></span>
        </a>
        <p class="footer-tagline">Zone 6 Tarum, Libmanan,<br>Camarines Sur, Philippines 4407</p>
        <div class="footer-accred-row">
            <span class="f-tag da">DA</span><span class="f-tag ati">ATI</span>
            <span class="f-tag rcef">RCEF</span><span class="f-tag lsa">LSA</span><span class="f-tag tesda">TESDA</span>
        </div>
    </div>
    <div class="footer-col">
        <h4>Navigation</h4>
        <ul>
            <li><a href="#accreditation"><svg viewBox="0 0 16 16" fill="none"><polygon points="8,2 9.5,6 14,6 10.5,9 11.5,14 8,11 4.5,14 5.5,9 2,6 6.5,6" stroke="currentColor" stroke-width="1.2" fill="none"/></svg>Accreditation</a></li>
            <li><a href="#our-beginnings"><svg viewBox="0 0 16 16" fill="none"><circle cx="8" cy="5" r="2.5" stroke="currentColor" stroke-width="1.2"/><path d="M3 14C3 11.24 5.24 9 8 9s5 2.24 5 5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>Our Beginnings</a></li>
            <li><a href="#breeds"><svg viewBox="0 0 16 16" fill="none"><path d="M2 8C2 4.69 4.69 2 8 2s6 2.69 6 6-2.69 6-6 6-6-2.69-6-6z" stroke="currentColor" stroke-width="1.2"/></svg>Available Breeds</a></li>
            <li><a href="#programs"><svg viewBox="0 0 16 16" fill="none"><path d="M8 2C5.79 2 4 3.79 4 6C4 7.74 5.06 9.23 6.56 9.82L6 13H10L9.44 9.82C10.94 9.23 12 7.74 12 6C12 3.79 10.21 2 8 2Z" stroke="currentColor" stroke-width="1.2" fill="none"/></svg>What We Offer</a></li>
            <li><a href="#vision-mission"><svg viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6" stroke="currentColor" stroke-width="1.2"/><circle cx="8" cy="8" r="2" stroke="currentColor" stroke-width="1.2"/></svg>Vision &amp; Mission</a></li>
            <li><a href="#feedback"><svg viewBox="0 0 16 16" fill="none"><path d="M8 1.5C4.96 1.5 2.5 3.96 2.5 7C2.5 9.5 4.02 11.65 6.22 12.5V14.5L9.78 12.5C12.13 11.74 14 9.53 14 7C14 3.96 11.5 1.5 8 1.5Z" stroke="currentColor" stroke-width="1.2" fill="none"/></svg>Community Voices</a></li>
        </ul>
    </div>
    <div class="footer-col">
        <h4>Contact</h4>
        <ul>
            <li><a href="tel:09913870423"><svg viewBox="0 0 16 16" fill="none"><path d="M3 2H6L7.5 5.5L5.5 6.5C6.5 8.5 8 10 9.5 11L10.5 9L14 10.5V13.5C14 13.78 13.78 14 13.5 14C7 14 2 9 2 2.5C2 2.22 2.22 2 2.5 2H3Z" stroke="currentColor" stroke-width="1.2"/></svg>0991 387 0423</a></li>
            <li><a href="mailto:mercedessciencefarm2021@gmail.com"><svg viewBox="0 0 16 16" fill="none"><rect x="1" y="3" width="14" height="10" rx="1.5" stroke="currentColor" stroke-width="1.2"/><path d="M1 4L8 9L15 4" stroke="currentColor" stroke-width="1.2"/></svg>mercedessciencefarm2021@gmail.com</a></li>
            <li><a href="https://www.facebook.com/profile.php?id=100075980057886" target="_blank" rel="noopener"><svg viewBox="0 0 16 16" fill="none"><path d="M9 2H11V4H9C8.45 4 8 4.45 8 5V6H11L10.5 8H8V14H6V8H4V6H6V5C6 3.34 7.34 2 9 2Z" stroke="currentColor" stroke-width="1.2"/></svg>Facebook Page</a></li>
        </ul>
    </div>
    <div class="footer-col">
        <h4>Location</h4>
        <ul>
            <li><a href="https://maps.google.com/?q=Zone+6+TARUM+Libmanan+Camarines+Sur+Philippines+4407" target="_blank" rel="noopener"><svg viewBox="0 0 16 16" fill="none"><path d="M8 1.5C5.51 1.5 3.5 3.51 3.5 6C3.5 9.5 8 14.5 8 14.5S12.5 9.5 12.5 6C12.5 3.51 10.49 1.5 8 1.5Z" stroke="currentColor" stroke-width="1.2"/><circle cx="8" cy="6" r="1.75" stroke="currentColor" stroke-width="1.2"/></svg>Zone 6 TARUM,<br>Libmanan, Philippines 4407</a></li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p class="footer-copy">&copy; {{ date('Y') }} Mercedes Science Farm. All rights reserved.</p>
        <p class="footer-copy">Accredited by the Department of Agriculture &amp; TESDA · Philippines</p>
    </div>
</footer>

<script>
/* ── Scroll progress bar ────────────── */
const progressBar = document.getElementById('scroll-progress');
window.addEventListener('scroll', () => {
    const scrollTop = window.scrollY;
    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
    progressBar.style.width = (scrollTop / docHeight * 100) + '%';
    document.getElementById('mainNav').classList.toggle('scrolled', scrollTop > 30);
}, { passive: true });

/* ── Mobile nav ─────────────────────── */
const toggle = document.getElementById('navToggle');
const navLinks = document.getElementById('navLinks');
toggle.addEventListener('click', () => navLinks.classList.toggle('open'));
navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => navLinks.classList.remove('open')));

/* ── Smooth scroll for anchor links ─── */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            const navH = document.querySelector('nav').offsetHeight;
            const top = target.getBoundingClientRect().top + window.scrollY - navH - 16;
            window.scrollTo({ top, behavior: 'smooth' });
        }
    });
});

/* ── Scroll reveal ──────────────────── */
const revealEls = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
const revObserver = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
        if (e.isIntersecting) {
            setTimeout(() => e.target.classList.add('visible'), (e.target.dataset.delay || 0) * 1);
            revObserver.unobserve(e.target);
        }
    });
}, { threshold: 0.1 });
revealEls.forEach(el => revObserver.observe(el));

/* ── ANIMATED STATS ─────────────────── */
function animateYear(el, from, to, duration) {
    const start = performance.now();
    function step(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.childNodes[0].textContent = Math.round(from + (to - from) * eased);
        if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
}
function animateCount(el, from, to, duration) {
    const start = performance.now();
    function step(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        el.textContent = Math.round(from + (to - from) * eased);
        if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
}
function animateOrdinal(el, ordinalEl, from, to, duration) {
    const start = performance.now();
    const ord = ['', 'st', 'nd', 'rd', 'th'];
    function step(now) {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        const current = Math.round(from + (to - from) * eased);
        el.textContent = current;
        ordinalEl.textContent = ord[current] || 'th';
        if (progress < 1) requestAnimationFrame(step);
    }
    requestAnimationFrame(step);
}
const statsArea = document.getElementById('statsArea');
let statsAnimated = false;
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting && !statsAnimated) {
            statsAnimated = true;
            const yearEl = document.getElementById('statYear');
            animateYear(yearEl, 2025, 2021, 1800);
            setTimeout(() => animateCount(document.getElementById('statAccred'), 0, 5, 1200), 300);
            setTimeout(() => {
                animateOrdinal(
                    document.getElementById('statYear2'),
                    document.getElementById('statOrdinal'),
                    1, 4, 2000
                );
            }, 500);
        }
    });
}, { threshold: 0.5 });
statsObserver.observe(statsArea);

/* ── About image particles ──────────── */
(function() {
    const container = document.getElementById('aboutAnim');
    if (!container) return;
    const colors = ['rgba(92,52,148,0.6)','rgba(40,110,48,0.5)','rgba(168,132,30,0.5)','rgba(192,57,106,0.4)','rgba(255,255,255,0.4)'];
    for (let i = 0; i < 18; i++) {
        const p = document.createElement('div');
        p.className = 'anim-particle';
        const size = 4 + Math.random() * 8;
        p.style.cssText = `width:${size}px;height:${size}px;background:${colors[Math.floor(Math.random()*colors.length)]};left:${5+Math.random()*90}%;bottom:${Math.random()*60}%;--dur:${5+Math.random()*7}s;--delay:${Math.random()*6}s;filter:blur(${Math.random()*2}px);`;
        container.appendChild(p);
    }
})();

/* ── Stagger accred cards ────────────── */
const accredCards = document.querySelectorAll('.accred-card');
const cardObs = new IntersectionObserver((entries) => {
    entries.forEach((e, i) => {
        if (e.isIntersecting) {
            setTimeout(() => e.target.classList.add('visible'), i * 120);
            cardObs.unobserve(e.target);
        }
    });
}, { threshold: 0.08 });
accredCards.forEach(c => cardObs.observe(c));

/* ── CONTACT MODAL ───────────────────── */
const contactModal   = document.getElementById('contactModal');
const openModalBtn   = document.getElementById('openContactModal');
const closeModalBtn  = document.getElementById('contactModalClose');

function openModal() {
    contactModal.classList.add('open');
    document.body.style.overflow = 'hidden';
    closeModalBtn.focus();
}
function closeModal() {
    contactModal.classList.remove('open');
    document.body.style.overflow = '';
    openModalBtn.focus();
}

openModalBtn.addEventListener('click', openModal);
closeModalBtn.addEventListener('click', closeModal);

// Close on overlay click (outside modal box)
contactModal.addEventListener('click', (e) => {
    if (e.target === contactModal) closeModal();
});

// Close on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && contactModal.classList.contains('open')) closeModal();
});
</script>
</body>
</html>