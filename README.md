# Software Development Bootcamp Projects

This repository contains Software Development Bootcamp project prompts. Reference implementations are available at the [Software Development Bootcamp Reference Implementations](https://git.college.columbia.edu/software_development_bootcamp_project_reference_implementations) repository.

## Projects

### Bootcamp

* Course Project `course-lookup.md`

### Interview

* Course Interview Project `course-lookup-interview.md`

## Generating HTML/PDF versions

You may want to generate HTML or PDF versions of these projects. To do so, you'll need `pandoc`.

Here's an example of how to convert `course-lookup-interview.` to HTML.

```
$ pandoc -s -S course-lookup-interview.md -t html5 -o course-lookup-interview.html
```
