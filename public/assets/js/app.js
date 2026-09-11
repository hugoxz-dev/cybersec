document.addEventListener(
    'DOMContentLoaded',
    () =>
    {
        console.log(
            'cybersec iniciado.'
        );
    }
);
 const sidebar =
document.querySelector('.sidebar');

const content =
document.querySelector('.main-content');

const toggle =
document.getElementById(
    'sidebarToggle'
);

if(localStorage.getItem('sidebar') === 'closed')
{
    sidebar.classList.add('collapsed');
    content.classList.add('expanded');
}

if(toggle)
{
    toggle.addEventListener(
        'click',
        function()
        {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('expanded');

            localStorage.setItem(
                'sidebar',
                sidebar.classList.contains(
                    'collapsed'
                )
                ? 'closed'
                : 'open'
            );
        }
    );
}