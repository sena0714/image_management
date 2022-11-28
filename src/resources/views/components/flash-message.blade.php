@php
if (session('flashStatus') === 'info') $bgColor = 'blue';
if (session('flashStatus') === 'error') $bgColor = 'yellow';   
@endphp

@if (session('flashMessage'))
    <div class="alert {{ $bgColor }}">
        <span class="badge">{{ session('flashStatus') }}</span>
        {{ session('flashMessage') }}
        <button type="button" class="close">×</button>
    </div>
@endif

<script>
window.addEventListener('load', function() {
    addAlertCloseEvent();
});

function addAlertCloseEvent() {        
    document.querySelectorAll('.alert .close').forEach((alertCloseButton, index) => {
        alertCloseButton.addEventListener('click', (e) => {
            e.target.closest('.alert').style.display = 'none';
        });
    });
}
</script>

<style>
.alert {
    position: relative;
    width: fit-content;
    min-width: 350px;
    padding: 0.75rem 1.25rem;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
    padding-right: 4rem;
}

.alert.blue {
    color: #004085;
    background-color: #cce5ff;
    border-color: #b8daff;
}

.alert.gray {
    color: #464a4e;
    background-color: #e7e8ea;
    border-color: dddfe2;
}

.alert.green {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert.red {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

.alert.yellow {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeeba;
}

.alert .badge {
    display: inline-block;
    padding: 0.25rem 0.6rem;
    margin-right: 5px;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    color: white;
    border-radius: 10rem;
}

.alert.blue .badge {
    background-color: #007bff;
}

.alert.gray .badge {
    background-color: #868e96;
}

.alert.green .badge {
    background-color: #28a745;
}

.alert.red .badge {
    background-color: #dc3545;
}

.alert.yellow .badge {
    background-color: #ffc107;
}

.alert .close {
    cursor: pointer;
    position: absolute;
    top: 0;
    right: 0;
    padding: 0.75rem 1.25rem;
    background-color: transparent;
    border: 0;
    color: inherit;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: .5;
}

.alert .close:hover {
    color: #000;
    text-decoration: none;
    opacity: .75;
}
</style>