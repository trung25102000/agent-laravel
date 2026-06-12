output "pipeline_id" {
  description = "CodePipeline ID."
  value       = aws_codepipeline.this.id
}

output "pipeline_arn" {
  description = "CodePipeline ARN."
  value       = aws_codepipeline.this.arn
}

output "pipeline_name" {
  description = "CodePipeline name."
  value       = aws_codepipeline.this.name
}
