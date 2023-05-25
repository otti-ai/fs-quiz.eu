# General
This project provides a training website for the Formula Student Registration quizzes, so that the quizzes can be practiced in the original mode or in customized modes. The project is a compilation of all relevant data for the quizzes of the past years and contains more than 60 quizzes. Beside the quizzes also the documents (rules, handbooks and co.) are provided. This repository contains the source code of the website [fs-quiz.eu](https://fs-quiz.eu/) but not an image of the database.

## Documents
The repository contains the most important documents for the registration quizzes. They are stored in the [/data](/doc) folder. These include:
- Rulebook,
- Hybrid Rules,
- Additional Rules,
- Handbook.
For the web page an additional entry in the database is required, which contains the information about the version, year, event and type of the document.
See [API](https://api.fs-quiz.eu/) documentation [GET: /document/{doc_id}](https://api.fs-quiz.eu/#get-document)

## Images and tables
The images can be found in the [/img](/img) folder. There they are sorted by type (in progress).  
- [/question](/img/question): The images that belong to the questions are sorted here. Their name is determined by the ID of the question in the database and the order of the image.
- [/solutions](/img/solutions): Pictures that show the way to the solution. They also have the ID and the order as name.
- [/events](/img/events): Here the logos of the events are stored. The assignment is done via the database.
The images can be accessed on the website [img.fs-quiz.eu](https://img.fs-quiz.eu/) directly by their names.

Tables are also saved as an image to prevent incompatibilities with the public API.

## API
This project provides not only the website but also an API for the data in the database. This API is openly accessible and completely free, but requires an API key. More information about this in the API documentation under [Getting Started](https://api.fs-quiz.eu/#Getting).

The source code for the API can be found at [/api/1](/api/1). The 1 here stands for version 1. All changes within a version should be backward compatible. If this cannot be guaranteed a new version will be created.

The API documentation can be found under [api.fs-quiz.eu](https://api.fs-quiz.eu).

## Future
Here is a listing of planned changes on my part:
- API extended with create function to allow other teams to add questions, solutions and documents to the database.
- Extension of the settings for a quiz start
- Estimate if the result would have been enough for a qualification (based on the real results)
- Real test quiz in the middle of January (2-3 weeks before the official quizzes)
- Release and integration of my rule search tool from Team [Bremergy](https://bremergy.de/). Solves dependencies of rules and respects event specific rules.

## Known unfixed bugs
- When multiple answers to a question with a single correct solution are correct (accepted after protest) only one is displayed
- Characters for new line in solution texts are not applied.
