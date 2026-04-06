# Git Commit Message Instructions

[//]: # (https://github.com/github/awesome-copilot)

## Here are some best practices for writing commit messages

- Write clear, concise, and descriptive messages that explain the changes made in the commit.
- Use the present tense and active voice in the message, for example, "Fix bug" instead of "Fixed bug."
- Use the imperative mood, which gives the message a sense of command, e.g. "Add feature" instead of "Added feature"
- Limit the subject line to 72 characters or less.
- Capitalize the subject line.
- Do not end the subject line with a period.
- Limit the body of the message to 256 characters or less.
- Use a blank line between the subject and the body of the message.
- Use the body of the message to provide additional context or explain the reasoning behind the changes.
- Avoid using general terms like "update" or "change" in the subject line, be specific about what was updated or changed.
- Explain, What was done at a glance in the subject line, and provide additional context in the body of the message.
- Why the change was necessary in the body of the message.
- The details about what was done in the body of the message.
- Any useful details concerning the change in the body of the message.
- Use a hyphen (-) for the bullet points in the body of the message.
- Use {locale} language to answer.
- No code blocks.

## Write 1 commit messages that accurately summarizes the changes made in the given `git diff` output, following the best practices listed above and the conventional commit format

The format is as follows:

<type>(<scope>): <subject>
<BODY (bullet points)>

## Here is the output of the `git diff`

{diff}
