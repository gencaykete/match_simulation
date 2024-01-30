<style>
    .hidden {
        display: none !important;
    }

    .animated {
        animation: fadeIn 2s;
    }


    #animationDiv {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        gap: 30px;
        font-size: 2.5em;
        z-index: 1000;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .icon {
        animation: spin 3s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

</style>
<div id="animationDiv" class="hidden">
    <div class="icon">
        <svg fill="#ffffff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
             width="200px" height="200px" viewBox="0 0 31.492 31.492"
             xml:space="preserve">
        <g>
            <path d="M15.796,0.049c-0.017,0-0.033,0.002-0.05,0.003c-0.017,0-0.033-0.003-0.05-0.003C7.028,0.049,0,7.076,0,15.745
                s7.028,15.698,15.696,15.698c0.017,0,0.033-0.002,0.05-0.004c0.017,0,0.033,0.004,0.05,0.004c8.668,0,15.696-7.028,15.696-15.697
                S24.464,0.049,15.796,0.049z M16.826,4.605l4.087-0.47c1.543,0.683,2.922,1.665,4.069,2.871l0.521,4.164l-5.051,1.327l-3.627-2.525
                V4.605z M6.509,7.006c1.148-1.206,2.527-2.188,4.07-2.871l4.087,0.47v5.367l-3.627,2.525L5.988,11.17L6.509,7.006z M4.594,21.889
                c-0.878-1.58-1.418-3.365-1.55-5.267l2.155-3.593l5.116,1.344l1.294,4.27l-3.331,4.965L4.594,21.889z M18.65,28.107
                c-0.92,0.212-1.872,0.334-2.854,0.336c-0.017,0-0.033-0.002-0.05-0.002s-0.033,0.002-0.05,0.002
                c-0.983-0.002-1.935-0.124-2.854-0.336l-2.885-3.411l3.254-4.847h2.535h2.535l3.254,4.847L18.65,28.107z M23.214,23.607
                l-3.331-4.965l1.295-4.27l5.115-1.344l2.155,3.593c-0.132,1.901-0.673,3.687-1.55,5.267L23.214,23.607z"/>
        </g>
        </svg>
    </div>
    <div class="text"></div>
</div>

<div class="overlay toggle-icon"></div>
<!--end overlay-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
<footer class="page-footer">
    <p class="mb-0">Copyright © 2024. All right reserved. Gencay KETE</p>
</footer>
