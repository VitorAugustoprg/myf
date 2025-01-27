document.addEventListener('DOMContentLoaded', () => {
    const botaoAddCurso = document.getElementById('adicionarCurso');
    const cursoContainer = document.getElementById('cursos')

    botaoAddCurso.addEventListener('click', () => {
        const novoCurso = document.createElement("input");
        novoCurso.type = "text";
        novoCurso.name = "cursos[]";
        novoCurso.classList.add("inputs", "mb-2");
        novoCurso.placeholder = ("Digite outro curso");
        cursoContainer.appendChild(novoCurso);
    })
})

document.addEventListener('DOMContentLoaded', () => {
    const botaoAddFormacao = document.getElementById('adicionarFormacao');
    const formacaoContainer = document.getElementById('formacao')

    botaoAddFormacao.addEventListener('click', () => {
        const novaFormacao = document.createElement("input");
        novaFormacao.type = "text";
        novaFormacao.name = "formacao[]";
        novaFormacao.classList.add("inputs", "mb-2");
        novaFormacao.placeholder = ("Digite outra formação");
        formacaoContainer.appendChild(novaFormacao);
    })
})

document.addEventListener('DOMContentLoaded', () => {
    const botaoAddExperiencia = document.getElementById('adicionarExperiencia');
    const experienciaContainer = document.getElementById('experiencia')

    botaoAddExperiencia.addEventListener('click', () => {
        const novaExperiencia = document.createElement("input");
        novaExperiencia.type = "text";
        novaExperiencia.name = "experiencia[]";
        novaExperiencia.classList.add("inputs", "mb-2");
        novaExperiencia.placeholder = ("Digite outra experiência");
        experienciaContainer.appendChild(novaExperiencia);
    })
});


  