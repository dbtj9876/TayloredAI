export const ASSESSMENT_VERSION = 1;
export const SCORED_QUESTIONS = 11;
export const BOTTLENECKS = [
  'Manual admin work',
  'Slow response to customers',
  'Data and insight gaps',
  'Inconsistent quality / team adoption',
];

export function validAnswers(answers) {
  return Array.isArray(answers) && answers.length === SCORED_QUESTIONS + 1
    && answers.every((answer) => Number.isInteger(answer) && answer >= 0 && answer <= 3);
}

export function scoreAssessment(answers) {
  const total = answers.slice(0, SCORED_QUESTIONS).reduce((sum, answer) => sum + 3 - answer, 0);
  const score = Math.round(total / (SCORED_QUESTIONS * 3) * 100);
  const band = score >= 72 ? 'AI-Ready' : score >= 42 ? 'Emerging' : 'Foundations First';
  return { score, band, bottleneck: BOTTLENECKS[answers[SCORED_QUESTIONS]] };
}
